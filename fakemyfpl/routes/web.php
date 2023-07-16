<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhoaHocController;
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
    return response() -> json(["user" => [
        "ten" => "teo"
    ]]);
});
Route::prefix('khoahoc')->group(function(){
    Route::controller(KhoaHocController::class)->group(function(){
        Route::get('/','showDanhSachKhoaHoc')->name('showDanhSachKhoaHoc');
        Route::get('/addKhoaHoc','getAddKhoaHoc')->name('addKhoaHoc');
        Route::post('/addKhoaHoc','addKhoaHoc')->name('addKhoaHoc');
    });
    
   
});

    

