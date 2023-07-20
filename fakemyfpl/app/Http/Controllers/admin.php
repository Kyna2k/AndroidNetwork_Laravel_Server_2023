<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin as admin_controller;


class admin extends Controller
{
    private $admin;
    public function __construct()
    {
        $this->admin = new admin_controller();
    }
    public function getLogin(Request $request)
    {
        return view('admin.login');
    }
    public function login(Request $request)
    {
        $messages = [
            'required' => 'Trường :attribute vui lòng không để trống',
        ];
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ],$messages);
        $data = [
            "username" => $request->username
        ];
        $result =  $this->admin->login($data);
        if($result == null)
        {
            return redirect()->route('admin.login')->with('msg',"Tài khoản không tồn tại");
        }else{
            if($result->password === $request->password){
                return "đăng nhập thành cống";
            }else{
                return redirect()->route('admin.login')->with('msg',"Sai mật khẩu");
            }
        }
        return dd($result);
        
    }
}
