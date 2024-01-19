<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\obatalkesController;
use App\Http\Controllers\supplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/dashboard',dashboardController::class);

Route::controller(obatalkesController::class)->group(function(){
    Route::get('gudang/obatalkes','index')->name('obatalkes.index');
    Route::get('gudang/obatalkes/stok','stok')->name('obatalkes.stok');
    Route::get('gudang/obatalkes/create','create')->name('obatalkes.create');
    
});
Route::controller(supplierController::class)->group(function(){
    Route::get('gudang/supplier','index')->name('supplier.index');
    Route::get('gudang/supplier/create','create')->name('supplier.create');
    Route::post('gudang/supplier/store','store')->name('supplier.store');
    Route::put('gudang/supplier/update/{id}','update')->name('supplier.update');
    Route::get('gudang/supplier/{id}/edit','edit')->name('supplier.edit');
    Route::get('gudang/supplier/{id}/nonaktif','nonaktif')->name('supplier.nonaktif');
    Route::get('gudang/supplier/{id}/aktif','aktif')->name('supplier.aktif');
    Route::get('gudang/supplier/{id}/delete','delete')->name('supplier.delete');
});