<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\SinhVien;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Api ddang nhap
Route::post('/login',function(Request $request){
    $result = json_decode($request->getContent(), true);
    $controller = new SinhVien();
    $data = $controller->login($result["email"]);
    if($data != null)
    {
        return [
            "status"=> 200,
            "mess" => 'Dang nhap thanh cong',
            "data" => $data
        ];
    }
    return [
        "status"=> 304,
        "mess" => 'Dang nhap that bai',
        "data" => null
    ];
    
});

