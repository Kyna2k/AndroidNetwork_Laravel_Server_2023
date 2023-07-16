<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class KhoaHocController extends Controller{


    public function __construct()
    {
        
    }
    public function index()
    {
        
    }
    //Hien thi danh sach khoa hoc
    public function showDanhSachKhoaHoc()
    {
       
        return view('khoahoc.danhsachkhoahoc');
    }

    public function getAddKhoaHoc(Request $request){
        return view('khoahoc.addkhoahoc');
    }
    public function addKhoaHoc(Request $request)  {
        //Cách 1
        // $messages = [
        //     'Name.required' => "Vui nhập kí tự",
        //     'Name.min' => "Tối đa 255 kí tự",
        //     'PRICE'
        // ];
        //Cách 2
        //Validate sử dùng  flash để reload lại trang trước nếu xảy ra lỗi
        // require -> flash()
        //Do đó chúng ta có thể dùng old để lưu trữ lại
        // cách viết tay 
        $messages = [
            'required' => 'Trường :attribute vui lòng không để trống',
            'min' => 'Trường :attribute không được nhỏ hơn :min',
            'integer' =>'Trường :attribute bắt buộc phải là số'
        ];
        $request -> validate([
            'name' => 'required|min:6',
            'price' => 'required|integer',
            'IMAGE' => 'require|image|mime:jpeg,png'
        ],$messages);
    }
}