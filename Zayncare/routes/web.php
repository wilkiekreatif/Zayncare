<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\obatalkesController;
use App\Http\Controllers\poliController;
use App\Http\Controllers\registerController;
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
    return view('dashboard.index');
});

Route::resource('/dashboard',dashboardController::class);

Route::controller(obatalkesController::class)->group(function(){
    Route::get('gudang/obatalkes','index')->name('obatalkes.index');
    Route::get('gudang/obatalkes/defekta','defekta')->name('obatalkes.defekta');
    Route::get('gudang/obatalkes/stokopname','stokopname')->name('obatalkes.stokopname');
    Route::get('gudang/obatalkes/defektabaru','defektabaru')->name('obatalkes.defektabaru');
    Route::get('gudang/obatalkes/stok','stok')->name('obatalkes.stok');
    Route::get('gudang/obatalkes/create','create')->name('obatalkes.create');
    Route::post('gudang/obatalkes/store','store')->name('obatalkes.store');
    Route::put('gudang/obatalkes/update/{id}','update')->name('obatalkes.update');
    Route::get('gudang/obatalkes/{id}/edit','edit')->name('obatalkes.edit');
    Route::get('gudang/obatalkes/{id}/nonaktif','nonaktif')->name('obatalkes.nonaktif');
    Route::get('gudang/obatalkes/{id}/aktif','aktif')->name('obatalkes.aktif');
    Route::get('gudang/obatalkes/{id}/delete','delete')->name('obatalkes.delete');
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
Route::controller(registerController::class)->group(function(){
    Route::get('register','index')->name('register.index');
    Route::get('register/create','create')->name('register.create');
    Route::post('register/store','store')->name('register.store');
    Route::post('register/regist','registpasien')->name('register.registpasien');
    Route::get('register/registered','registered')->name('register.registered');
    Route::get('register/{id}/pulangkan','pulangkan')->name('register.pulangkan');
    Route::get('register/{id}/batalperiksa','batalperiksa')->name('register.batalperiksa');
});
Route::controller(poliController::class)->group(function(){
    Route::get('poliklinik','index')->name('poliklinik.index');
    Route::get('poliklinik/{id}/periksa','periksa')->name('poliklinik.periksa');
    Route::get('poliklinik/{id}/reseppoli','reseppoli')->name('poliklinik.reseppoli');
    Route::put('poliklinik/{id}/anamnesa','anamnesa')->name('poliklinik.anamnesa');
    Route::post('poliklinik/{id}/tindakan','tindakan')->name('poliklinik.tindakan');
    Route::put('poliklinik/{id}/bataltindakan','bataltindakan')->name('poliklinik.bataltindakan');
    Route::get('poliklinik/{id}/doneresep','doneresep')->name('poliklinik.doneresep');
    Route::get('poliklinik/{id}/kembalikan','kembalikan')->name('poliklinik.kembalikan');
    Route::get('poliklinik/{id}/pulangkan','pulangkan')->name('poliklinik.pulangkan');
    Route::get('poliklinik/{id}/batalperiksa','batalperiksa')->name('poliklinik.batalperiksa');
    Route::get('poliklinik/{id}','getTarifobat')->name('poliklinik.getTarifobat');
    Route::put('poliklinik/{id}/tambahobatalkes','tambahobatalkes')->name('poliklinik.tambahobatalkes');
    Route::put('poliklinik/{trx_id}/deleteobat','deleteobat')->name('poliklinik.deleteobat');
});
Route::get('/construction', function () {
    return view('construction.index');
});