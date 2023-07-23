<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
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
    $data = DB::table('USERS')->where('username',$result["username"])->first();
    
    
    if($data != null)
    {
        if($data->password === $result["password"])
        {
        return [
            "status"=> 200,
            "mess" => 'Dang nhap thanh cong',
            "data" => $data
        ];
        }else{
            return [
                "status"=> 200,
                "mess" => 'Sai mật khẩu',
                "data" => null
            ];
        }
        
    }
    return [
        "status"=> 400,
        "mess" => 'Dang nhap that bai',
        "data" => null
    ];
    
});
Route::post('/sign',function(Request $request){
    $result = json_decode($request->getContent(), true);
    $data = DB::table('USERS')->insert($result);
    
    
    if($data != null)
    {
        $data = DB::table('USERS')->where('username',$result["username"])->first();
        return [
            "status"=> 200,
            "mess" => 'Dang ký thanh cong',
            "data" => $data
        ];
        
    }
    return [
        "status"=> 400,
        "mess" => 'Dang ky that bai',
        $data => null
    ];
    
});

