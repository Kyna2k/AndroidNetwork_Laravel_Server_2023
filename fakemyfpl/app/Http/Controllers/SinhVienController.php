<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SinhVien;
class SinhVienController extends Controller
{
    //
    protected $SinhVien;
    const PAGE = 4;
    public function __construct()
    {
        $this->SinhVien = new SinhVien();
    }
    public function showDanhSachSinhVien(){
        $list = $this->SinhVien->GetDanhSach($this::PAGE);
        return view('sinhvien.danhsachsinhvien',compact('list'));
    }
}
