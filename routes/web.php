<?php

use App\Http\Controllers\apotekController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\infoController;
use App\Http\Controllers\kasirController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\obatalkesController;
use App\Http\Controllers\poliController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\reportController;
use App\Http\Controllers\supplierController;
use App\Http\Controllers\tindakanController;
use App\Http\Controllers\userController;
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

// Route::get('/', function () {
//     return view('login.index');
// });

// Route::resource('/',loginController::class);

Route::controller(loginController::class)->group(function(){
    Route::get('/','index')->name('login');
    Route::post('/login-process','loginproses')->name('login.proses');
    Route::get('/logout','logout')->name('logout');
});

Route::middleware('auth')->group(function(){

    Route::resource('/dashboard',dashboardController::class);

    Route::controller(obatalkesController::class)->group(function(){
        Route::get('gudang/obatalkes','index')->name('obatalkes.index');
        Route::get('gudang/obatalkes/defekta','defekta')->name('obatalkes.defekta');
        Route::post('gudang/obatalkes/tambahdefekta','tambahdefekta')->name('tambahdefekta');
        Route::get('gudang/obatalkes/bataldefekta/{id}','bataldefekta')->name('bataldefekta');
        Route::get('gudang/obatalkes/hapusdefekta/{id}','hapusdefekta')->name('hapusdefekta');
        Route::get('gudang/obatalkes/aktifkandefekta/{id}','aktifkandefekta')->name('aktifkandefekta');
        Route::put('gudang/obatalkes/verifikasidefekta/{id}','verifikasidefekta')->name('verifikasidefekta');
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
        Route::get('poliklinik/{id}/reseppoli','reseppoli')->name('poliklinik.reseppoli');
        Route::post('poliklinik/{id}/tindakan','tindakan')->name('poliklinik.tindakan');
        Route::put('poliklinik/{id}/bataltindakan','bataltindakan')->name('poliklinik.bataltindakan');
        Route::get('poliklinik/{id}/doneresep','doneresep')->name('poliklinik.doneresep');
        Route::get('poliklinik/{id}/kembalikan','kembalikan')->name('poliklinik.kembalikan');
        Route::get('poliklinik/{id}/pulangkan','pulangkan')->name('poliklinik.pulangkan');
        Route::get('poliklinik/{id}/batalperiksa','batalperiksa')->name('poliklinik.batalperiksa');
        Route::get('poliklinik/{id}/tarifobat','getTarifobat')->name('poliklinik.getTarifobat');
        Route::get('poliklinik/{id}','getTariftindakan')->name('poliklinik.getTariftindakan');
        Route::put('poliklinik/{id}/tambahobatalkes','tambahobatalkes')->name('poliklinik.tambahobatalkes');
        Route::put('poliklinik/{trx_id}/deleteobat','deleteobat')->name('poliklinik.deleteobat');
        Route::get('poliklinik/periksa/{id}','periksa')->name('poliklinik.periksa'); 
        Route::post('poliklinik/simpan/anamnesa/{id}','anamnesa')->name('poliklinik.anamnesa');
        Route::put('poliklinik/hapustindakan/{id}','deletetindakan')->name('poliklinik.deletetindakan');
        Route::post('poliklinik/updateAlergi/{id}','updateAlergi')->name('poliklinik.updateAlergi');
    });

    Route::controller(kasirController::class)->group(function(){
        Route::get('kasir','index')->name('kasir.index');
        Route::get('kasir/prosesbayar/{id}','prosesBayar')->name('kasir.prosesBayar');
        Route::post('kasir/simpanpembayaran/{id}','simpanPembayaran')->name('kasir.simpanBayar');
        Route::get('kasir/pembayaran_umum','pembayaranUmum')->name('kasir.pembayaranUmum');
        Route::get('kasir/pembayaran_umum/{id}','prosesBayarUmum')->name('kasir.prosesBayarUmum');
        Route::post('kasir/simpanpembayaranumum/{id}','simpanPembayaranUmum')->name('kasir.simpanPembayaranUmum');
        Route::get('kasir/print_kwitansi/{id}','printKwitansi')->name('kasir.printKwitansi');
    });

    Route::controller(apotekController::class)->group(function(){
        Route::get('apotek','index')->name('apotek.index');
        Route::get('apotek/penjualan','pu')->name('apotek.pu');
        Route::put('apotek/{trx_id}/deleteobatalkes','deleteobatalkes')->name('apotek.deleteobatalkes');
        Route::get('apotek/penjualanUmum','jualumum')->name('apotek.jualumum');
        Route::get('apotek/{id}/verifresep','verifresep')->name('apotek.verifresep');
        Route::get('apotek/{id}/serahresep','serahresep')->name('apotek.serahresep');
        Route::get('apotek/{id}/serahresepumum','serahresepumum')->name('apotek.serahresepumum');
        Route::get('apotek/{id}/resepvalidate','resepvalidate')->name('apotek.resepvalidate');
        Route::get('apotek/penjualan/{id}','sendtokasir')->name('apotek.sendtokasir');
    });

    Route::controller(userController::class)->group(function(){
        Route::get('sysadmin/master/users','index')->name('users.index');
        Route::get('sysadmin/master/users/create','create')->name('users.create');
        Route::post('sysadmin/master/users/create','store')->name('users.store');
        Route::get('sysadmin/master/users/nonaktif/{id}','nonaktif')->name('users.nonaktif');
        Route::get('sysadmin/master/users/aktifkan/{id}','aktifkan')->name('users.aktifkan');
        Route::get('sysadmin/master/users/hapus/{id}','hapus')->name('users.hapus');
    });

    Route::controller(tindakanController::class)->group(function(){
        Route::get('sysadmin/master/tindakan','index')->name('tindakan.index');
        Route::get('sysadmin/master/tindakan/create','create')->name('tindakan.create');
        Route::post('sysadmin/master/tindakan/store','store')->name('tindakan.store');
        Route::get('sysadmin/master/tindakan/nonaktif/{id}','nonaktif')->name('tindakan.nonaktif');
        Route::get('sysadmin/master/tindakan/aktifkan/{id}','aktifkan')->name('tindakan.aktifkan');
        Route::get('sysadmin/master/tindakan/hapus/{id}','hapus')->name('tindakan.hapus');
    });

    Route::controller(infoController::class)->group(function(){
        Route::get('sysadmin/config/preferences','index')->name('preferences.index');
        Route::post('sysadmin/config/preferences','update')->name('preferences.update');
    });

    Route::controller(reportController::class)->group(function(){
        Route::get('report/tracer/{id}','tracer')->name('tracer');
    });

    Route::get('/construction', function () {
        return view('construction.index');
    });
});
