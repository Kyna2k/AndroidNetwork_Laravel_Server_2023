<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\SinhVien;
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
            "id_lop" =>$data->id_lop,
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

Route::get('/get-danh-sach-lop',function(Request $request){
    $token = $request->header('Authorization');
    $jwt = new JWT();
    $payload = $jwt->is_jwt_valid($jwt->get_bearer_token($token));
    return [
        "token" => $jwt->get_bearer_token($token),
        "payload" => json_decode($payload["payload"])
    ];
});