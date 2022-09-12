<?php

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

Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth'])->name('dashboard');

Route::resource('/customers', '\App\Http\Controllers\CustomerController')->middleware(['auth']);
Route::resource('/addresses', '\App\Http\Controllers\AddressController')->middleware(['auth']);
Route::resource('/serviceOrder', '\App\Http\Controllers\ServiceOrderController')->middleware(['auth']);
Route::resource('/items', '\App\Http\Controllers\ItemController')->middleware(['auth']);
Route::resource('/itemsType', '\App\Http\Controllers\ItemTypeController')->middleware(['auth']);

require __DIR__ . '/auth.php';
