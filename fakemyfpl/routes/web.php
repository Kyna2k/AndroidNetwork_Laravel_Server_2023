<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhoaHocController;
use App\Http\Controllers\admin;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\LopController;
use App\Http\Controllers\MonHocController;
use App\Http\Controllers\LoaiBaiVietController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\GiaoVienController;
use App\Http\Controllers\LichHocController;
use App\Models\jwt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
Route::get('/index.html', function () {
    return redirect()->route('sinhvien.showDanhSachSinhVien');
});
Route::get('/reset-pass',function(Request $request){
    $token = $request->query('token');
    $email = $request->query('email');
    if($token === null || $email === null || $email === "")
    {
        return view('Error.404');
    }
   
    $jwt = new jwt();
    $get_token = $jwt->is_jwt_valid($token);
    $data = DB::table('reset_password')->where('email', $email)->where('token',$token)->first();
    if($get_token["check"] && $data !=null && $data->avaiable)
    {
        return view('resetpass.reset',compact('email','token'));
        
    }else {
        return view('Error.404');
    }
});
Route::post('/reset-pass',function(Request $request){
    $token = $request->query('token');
    $email = $request->query('email');
    if($token === null || $email === null || $email === "")
    {
        return view('Error.404');
    }
   
    $jwt = new jwt();
    $get_token = $jwt->is_jwt_valid($token);
    $data = DB::table('USERS')->where('EMAIL', $email)->first();
    if($get_token["check"] && $data !=null)
    {
        if($request->repassword === $request->password){
            DB::table('USERS')->where('EMAIL',$email)->update(["PASSWORD"=>$request->password]);
            DB::table('reset_password')->where('email', $email)->where('token',$token)->update([
                'avaiable'=> 0
            ]);
            return "Thành công ròi";

        }else{
            return "Toang vl";
        }
    }else {
        echo("2");
        return view('Error.404');
    }
})->name('reset-pass');
Route::get('/avaiable',function(Request $request){
    $token = $request->query('token');
    $email = $request->query('email');
    if($token === null || $email === null || $email === "")
    {
        return view('Error.404');
    }
   
    $jwt = new jwt();
    $get_token = $jwt->is_jwt_valid($token);
    $data = DB::table('USERS')->where('EMAIL', $email)->first();
    if($get_token["check"] && $data !=null)
    {
        if($request->repassword === $request->password){
            DB::table('USERS')->where('EMAIL',$email)->update(["avaiable"=>1]);
            return "Kích hoạt thành công";

        }else{
            return "Toang vl";
        }
    }else {
        echo("2");
        return view('Error.404');
    }
})->name('reset-pass');
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
        Route::get('/addSinhVien','getAddSinhVien')->name('addSinhVien');
        Route::post('/addSinhVien','addSinhVien')->name('addSinhVien');
        Route::get('/editSinhVien/{id}','getEditSinhVien')->name('editSinhVien');
        Route::post('/editSinhVien/{id}','editSinhVien')->name('editSinhVien');
        Route::get('/delete/{id}','delete')->name('delete');
    });
});
    

Route::prefix('lop')->name('lop.')->group(function(){
    Route::controller(LopController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/addlop','create')->name('create');
        Route::post('/addlop','store')->name('store');
        Route::get('/editlop/{id}','edit')->name('edit');
        Route::post('/editlop/{id}','update')->name('update');
        Route::get('/delete/{id}','destroy')->name('destroy');
    });
});

Route::prefix('loaibaiviet')->name('loaibaiviet.')->group(function(){
    Route::controller(LoaiBaiVietController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/addloaibaiviet','create')->name('create');
        Route::post('/addloaibaiviet','store')->name('store');
        Route::get('/editloaibaiviet/{id}','edit')->name('edit');
        Route::post('/editloaibaiviet/{id}','update')->name('update');
        Route::get('/delete/{id}','destroy')->name('destroy');
    });
});

Route::prefix('baiviet')->name('baiviet.')->group(function(){
    Route::controller(BaiVietController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/addbaiviet','create')->name('create');
        Route::post('/addbaiviet','store')->name('store');
        Route::get('/editbaiviet/{id}','edit')->name('edit');
        Route::post('/editbaiviet/{id}','update')->name('update');
        Route::get('/delete/{id}','destroy')->name('destroy');
    });
});

Route::prefix('monhoc')->name('monhoc.')->group(function(){
    Route::controller(MonHocController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/addmonhoc','create')->name('create');
        Route::post('/addmonhoc','store')->name('store');
        Route::get('/editmonhoc/{id}','edit')->name('edit');
        Route::post('/editmonhoc/{id}','update')->name('update');
        Route::get('/delete/{id}','destroy')->name('destroy');
    });
});

Route::prefix('giaovien')->name('giaovien.')->group(function(){
    Route::controller(GiaoVienController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/addgiaovien','create')->name('create');
        Route::post('/addgiaovien','store')->name('store');
        Route::get('/editgiaovien/{id}','edit')->name('edit');
        Route::post('/editgiaovien/{id}','update')->name('update');
        Route::get('/delete/{id}','destroy')->name('destroy');
    });
});

Route::prefix('lichhoc')->name('lichhoc.')->group(function(){
    Route::controller(LichHocController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/addlichhoc','create')->name('create');
        Route::post('/addlichhoc','store')->name('store');
        Route::get('/editlichhoc/{id}','edit')->name('edit');
        Route::post('/editlichhoc/{id}','update')->name('update');
        Route::get('/delete/{id}','destroy')->name('destroy');
        Route::get('/tool-add-lich-hoc','gettooladdlichhoc')->name('gettool');
        Route::post('/tool-add-lich-hoc','tooladdlichhoc')->name('tool');
    });
});