<?php

use App\Http\Controllers\GenToken;
use App\Mail\MyTestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\SinhVien;
use App\Models\BaiViet;
use App\Models\LichHoc;
use App\Models\LoaiBaiViet;
use App\Models\jwt as JWT;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\TryCatch;
use Exception as e;
use Illuminate\Support\Facades\DB;
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
Route::post('/login', function (Request $request) {
    $result = json_decode($request->getContent(), true);
    $controller = new SinhVien();
    $data = $controller->login($result["email"]);
    if ($data != null) {
        $jwt = new JWT();
        $token = $jwt->generate_jwt([
            "id" => $data->id,
            "exp" => time() + (60 * 150)
        ]);
        return [
            "status" => 200,
            "mess" => 'Dang nhap thanh cong',
            "data" => $data,
            "token" => $token
        ];
    }
    return [
        "status" => 304,
        "mess" => 'Dang nhap that bai',
        "data" => null
    ];
});
Route::post('/login2', function (Request $request) {
    $result = json_decode($request->getContent(), true);
    $data = DB::table('USERS')->where('EMAIL', $result["email"])->first();
    
    if ($data != null) {
        if(!$data->avaiable) return [
            "status" => 400,
            "mess" => 'Vui lòng kích hoạt tài khoảng',
        ];
        if ($data->PASSWORD === $result["password"]) {
            $jwt = new JWT();
            $token = $jwt->generate_jwt([
                "id" => $data->id,
                "exp" => time() + (60 * 150)
            ]);
            return [
                "status" => 200,
                "mess" => 'Dang nhap thanh cong',
                "data" => $data,
                "token" => $token
            ];
        } else {
            return [
                "status" => 200,
                "mess" => 'Sai mật khẩu',
                "data" => null
            ];
        }
    }
    return [
        "status" => 400,
        "mess" => 'Dang nhap that bai',
        "data" => null
    ];
});
Route::post('/sign',function(Request $request){
    $result = json_decode($request->getContent(), true);
    $data = DB::table('USERS')->insert($result);
    
    
    if($data != null)
    {
        $data = DB::table('USERS')->where('EMAIL',$result["EMAIL"])->first();
        $jwt = new JWT();
        $token = $jwt->generate_jwt([
            "exp" => time() + (60 * 150)
        ]);
        Mail::to($data->EMAIL)->send(new MyTestMail('Reset password: http://127.0.0.1:8000/avaiable?token='.$token.'&email='.$data->EMAIL));
        return [
            "status"=> 200,
            "mess" => 'Dang ký thanh cong',
            "data" => $data,
            "token" =>  $token
        ];
        
    }
    return [
        "status"=> 400,
        "mess" => 'Dang ky that bai',
        $data => null
    ];
    
});
Route::middleware('autAPi')->group(function () {
    Route::get('/get-danh-sach-viet', function (Request $request) {
        $baiviet = new BaiViet();
        $result = $baiviet->GetDanhSach(1);
        return [
            "status" => 200,
            "mess" => '',
            "data" => [
                "data" => $result->items(),
                'total' => $result->total(),
                'current_page' => $result->currentPage(),
                'last_page' => $result->lastPage(),
            ]
        ];
    });
    Route::get('/get-loai-bai-viet', function (Request $request) {
        $loaibaiviet = new LoaiBaiViet();
        $result = $loaibaiviet->Get();
        return [
            "status" => 200,
            "mess" => '',
            "data" => $result->items()
        ];
    });
    Route::get('/get-danh-sach-viet-theo-loai', function (Request $request) {
        $baiviet = new BaiViet();
        $result = $baiviet->GetDanhSachTheoLoai($request->query('id_loai'));
        return [
            "status" => 200,
            "mess" => '',
            "data" => [
                "data" => $result->items(),
                'total' => $result->total(),
                'current_page' => $result->currentPage(),
                'last_page' => $result->lastPage(),
            ]
        ];
    });
    Route::get('/lich-hoc-theo-ngay', function (Request $request) {
        $lichhoc = new LichHoc();
        $result = $lichhoc->GetLopTheoNgay($request->query('thoigian'), $request->query('id_lop'));
        return [
            "status" => 200,
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
    Route::get('/lich-hoc-theo-thang', function (Request $request) {
        $lichhoc = new LichHoc();
        $result = $lichhoc->GetLopTheoThang($request->query('thoigian'), $request->query('id_lop'));
        return [
            "status" => 200,
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
    Route::get('/lich-hoc', function (Request $request) {
        $lichhoc = new LichHoc();
        $result = $lichhoc->GetLop($request->query('id_lop'));
        return [
            "status" => 200,
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

    Route::get('/lich-thi', function (Request $request) {
        $lichhoc = new LichHoc();
        $result = $lichhoc->GetLopThi($request->query('id_lop'));
        return [
            "status" => 200,
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
    Route::get('/token_noti', function (Request $request) {
        $token = new GenToken();
        return $token->getGoogleAccessToken();
    });
    Route::post('/send-mail-resetpass', function (Request $request) {
        $jwt = new JWT();
        $token = $jwt->generate_jwt([
            "exp" => time() + (60 * 150)
        ]);
        $email = $request->email;
        try {
            Mail::to($email)->send(new MyTestMail('Reset password: http://127.0.0.1:8000/reset-pass?token='.$token.'&email='.$email));
            $data  = [
                "token" =>$token,
                "email" => $email,
            ];
            $result = DB::table("reset_password")->insert(
                $data
            );
            return [
                "status" => 200,
                "mess" => 'Gửi Mail thành công',
                "data" => [$result]
            ];
        } catch (e $e) {
            return [
                "status" => 200,
                "mess" => 'Gửi Mail Thất bại',
                "data" => [$e]
            ];
        }
    });
});
