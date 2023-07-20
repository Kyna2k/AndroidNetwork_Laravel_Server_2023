<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhoaHocController;
use App\Http\Controllers\admin;
use App\Http\Controllers\SinhVienController;

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
    return redirect()->route('admin.login');
});

Route::prefix('khoahoc')->name('khoahoc.')->group(function(){
    Route::controller(KhoaHocController::class)->group(function(){
        Route::get('/','showDanhSachKhoaHoc')->name('showDanhSachKhoaHoc');
        Route::get('/addKhoaHoc','getAddKhoaHoc')->name('addKhoaHoc');
        Route::post('/addKhoaHoc','addKhoaHoc')->name('addKhoaHoc');
        Route::get('/editKhoaHoc/{id}','getEditKhoaHoc')->name('editKhoaHoc');
        Route::post('/editKhoaHoc/{id}','editKhoaHoc')->name('editKhoaHoc');
        Route::get('/delete/{id}','delete')->name('delete');
    });
});

Route::prefix('admin')->name('admin.')->group(function(){
    Route::controller(admin::class)->group(function(){
        Route::get('/','getLogin')->name('login');
        Route::post('/','login')->name('login');
    });
});

Route::prefix('sinhvien')->name('sinhvien.')->group(function(){
    Route::controller(SinhVienController::class)->group(function(){
        Route::get('/','showDanhSachSinhVien')->name('showDanhSachSinhVien');
    });
});
    

