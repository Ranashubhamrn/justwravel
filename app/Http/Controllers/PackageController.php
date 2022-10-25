<?php

namespace App\Http\Controllers;

use App\Models\Occupancy;
use App\Models\Package;
use Illuminate\Http\Request;
use Stringable;

class PackageController extends Controller
{

    public function index()
    {
        if (request()->wantsJson()) {
            return $this->getData();
        } else {
            return view('package.index');
        }
    }


    public function create()
    {
        $occupancies = Occupancy::all();
        return view('package.create', compact("occupancies"));
    }


    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'duration' => 'required',
            'occupancy_id' => 'required'
        ]);
        $slug = \Str::slug($request->title, '-');


        $package = Package::create($request->all() + ['slug' => $slug]);
        return back()->withSuccess("Package added succesfully");
    }
    public function getData()
    {
        $start = request()->start ?? 0;
        $limit = request()->length ?? 10;
        $search = request()->search ?? '';
        $search_value = ($search != '') ? $search['value'] : '';
        $draw = request()->draw ?? '';
        $columnIndex = request()->order[0]['column'] ?? 0; // Column index
        $columnName = request()->columns[$columnIndex]['data'] ?? 'created_at'; // Column name
        $columnSortOrder = request()->order[0]['dir'] ?? 'desc'; // asc or desc
        $que = Package::select('packages.*', 'occupancies.price', 'occupancies.occupancy', 'occupancies.disc_price')
            ->join('occupancies', 'occupancies.id', '=', 'packages.occupancy_id')
            ->when($search_value, function ($query) use ($search_value) {
                $query->where('title', 'like', '%' . $search_value . '%');
            })
            ->when($columnName, function ($query) use ($columnName, $columnSortOrder) {
                if (in_array($columnName, ['price', 'disc_price'])) {
                    $query->orderBy('occupancies.' . $columnName, $columnSortOrder);
                } else {
                    $query->orderBy('packages.' . $columnName, $columnSortOrder);
                }
            });

        $packges_count = $que->get()->count();
        $packges = $que->skip($start)->take($limit)->get();
        return   ['data' => $packges->map(function ($package) {
            $new_package = (object)[];
            $new_package->id = $package->id;


            $new_package->title = $package->title;
            $new_package->slug = $package->slug;
            $new_package->price = $package->price;
            $new_package->occupancy = $package->occupancy;
            $new_package->disc_price = $package->disc_price;
            $new_package->duration = $package->duration;




            return $new_package;
        }), 'draw' => $draw, 'total' => $packges_count];
    }
}
