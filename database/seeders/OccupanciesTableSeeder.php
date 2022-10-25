<?php

namespace Database\Seeders;

use App\Models\Occupancy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OccupanciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $occupancies = [
            [
                'occupancy'  =>  'Double Occupnacy',
                'price' =>  '8000',
                'disc_price' =>  '7800'
            ],
            [
                'occupancy'  =>  'Triple occupancy',
                'price' =>  '7500',
                'disc_price' =>  '7200'
            ],
            [
                'occupancy'  =>  'Quad Occupancy',
                'price' =>  '7000',
                'disc_price' =>  '6800'
            ],
        ];
        foreach ($occupancies as $occupancy) {
            Occupancy::updateOrCreate(['occupancy' => $occupancy['occupancy']], $occupancy);
        }
    }
}
