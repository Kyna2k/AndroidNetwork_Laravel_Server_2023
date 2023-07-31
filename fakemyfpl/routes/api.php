<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\SinhVien;
use App\Models\BaiViet;
use App\Models\LichHoc;
use App\Models\LoaiBaiViet;
use App\Models\jwt as JWT;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//Api ddang nhap
Route::post('/login',function(Request $request){
    $result = json_decode($request->getContent(), true);
    $controller = new SinhVien();
    $data = $controller->login($result["email"]);
    if($data != null)
    {
        $jwt = new JWT();
        $token = $jwt->generate_jwt([
            "id" => $data->id,
            "exp" => time() + (60*150)
        ]);
        return [
            "status"=> 200,
            "mess" => 'Dang nhap thanh cong',
            "data" => $data,
            "token" => $token
        ];
    }
    return [
        "status"=> 304,
        "mess" => 'Dang nhap that bai',
        "data" => null
    ]; 
});

Route::middleware('autAPi')->group(function(){
    Route::get('/get-danh-sach-viet',function(Request $request){
        $baiviet = new BaiViet();
        $result = $baiviet->GetDanhSach(1);
        return [
            "status"=> 200,
            "mess" => '',
            "data" => [
                "data" => $result->items(),
                'total' => $result->total(),
                'current_page' => $result->currentPage(),
                'last_page' => $result->lastPage(),
            ]
        ];

    });
    Route::get('/get-loai-bai-viet',function(Request $request){
        $baiviet = new BaiViet();
        $result = $baiviet->GetDanhSach(1);
        return [
            "status"=> 200,
            "mess" => '',
            "data" => [
                "data" => $result->items(),
                'total' => $result->total(),
                'current_page' => $result->currentPage(),
                'last_page' => $result->lastPage(),
            ]
        ];

    });
    Route::get('/get-danh-sach-viet-theo-loai',function(Request $request){
        $baiviet = new BaiViet();
        $result = $baiviet->GetDanhSachTheoLoai($request->query('id_loai'));
        return [
            "status"=> 200,
            "mess" => '',
            "data" => [
                "data" => $result->items(),
                'total' => $result->total(),
                'current_page' => $result->currentPage(),
                'last_page' => $result->lastPage(),
            ]
        ];

    });
    Route::get('/lich-hoc',function(Request $request){
        $lichhoc = new LichHoc();
        $result = $lichhoc->GetLop($request->query('id_lop'));
        return [
            "status"=> 200,
            "mess" => '',
            "data" => [
                "data" => $result->items(),
                'total' => $result->total(),
                'current_page' => $result->currentPage(),
                'last_page' => $result->lastPage(),
            ]
        ];
        return [
            $request->query('id_lop')
        ];
    });
    Route::get('/lich-thi',function(Request $request){
        $lichhoc = new LichHoc();
        $result = $lichhoc->GetLopThi($request->query('id_lop'));
        return [
            "status"=> 200,
            "mess" => '',
            "data" => [
                "data" => $result->items(),
                'total' => $result->total(),
                'current_page' => $result->currentPage(),
                'last_page' => $result->lastPage(),
            ]
        ];
        return [
            $request->query('id_lop')
        ];
    });
});