<?php

use App\Http\Controllers\PackageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('package.index');
// });
Route::get('/', [PackageController::class, 'index'])->name('get-package');
Route::get('package-create', [PackageController::class, 'create'])->name('package-create');
Route::post('package-store', [PackageController::class, 'store'])->name('package-store');
