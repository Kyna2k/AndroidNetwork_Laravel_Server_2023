<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\Lop;
use App\Models\Cloudinary;

class SinhVienController extends Controller
{
    //
    protected $SinhVien,$Lop;
    private $cloudinary;

    const PAGE = 4;
    
    public function __construct()
    {
        $this->SinhVien = new SinhVien();
        $this->Lop = new Lop();
        $this->cloudinary = new Cloudinary();

    }
    public function showDanhSachSinhVien(){
        $list = $this->SinhVien->GetDanhSach($this::PAGE);
         return view('sinhvien.danhsachsinhvien',compact('list'));

    }
    public function getAddSinhVien() {
        $listLop = $this->Lop->GetList();
        return view('sinhvien.addsinhvien',compact('listLop'));
    }
    public function addSinhVien(Request $request) {
        $messages = [
            'required' => 'Trường :attribute vui lòng không để trống',
        ];
        $request -> validate([
            'masinhvien' => 'required|min:6',
            'hoten' => 'required',
            'email' => 'required',
            'khoa' => 'required',
            'id_lop' => 'required',
        ],$messages);
        $result = null;
        if($request->hasFile('image') != null)
        {
            $image = $this->cloudinary->upload($request->image->path());
            $data = [
                "masinhvien"=> $request->masinhvien,
                "hoten" => $request->hoten,
                "email" => $request->email,
                "khoa" => $request->khoa,
                "id_lop"=>  $request->id_lop,
                "IMAGE" => $image
            ];
            $result =  $this->SinhVien->AddSinhVien($data);
        }else{
            $data = [
                "masinhvien"=> $request->masinhvien,
                "hoten" => $request->hoten,
                "email" => $request->email,
                "khoa" => $request->khoa,
                "id_lop"=>  $request->id_lop,
            ];
            $result =  $this->SinhVien->AddSinhVien($data);
        }
        return redirect()->route('sinhvien.showDanhSachSinhVien')->with('msg','Thêm sinh viên thành công');
    }
    public function getEditSinhVien(string $id){
        if(empty($id))
        {
            return view('Error.404');
        }
        $listLop = $this->Lop->GetList();
        $sinhvien = $this->SinhVien->GetSinhVien($id);
        if($sinhvien === null){
            return view('Error.404');
        }
        return view('sinhvien.editsinhvien',compact('sinhvien','listLop'));
    }
    public function editSinhVien(Request $request, $id)
    {
        $messages = [
            'required' => 'Trường :attribute vui lòng không để trống',
        ];
        $request -> validate([
            'masinhvien' => 'required|min:6',
            'hoten' => 'required',
            'email' => 'required',
            'khoa' => 'required',
            'id_lop' => 'required',
            'IMAGE' => 'require|image|mime:jpeg,png'
        ],$messages);
        if($request->hasFile('image') != null)
        {
            $image = $this->cloudinary->upload($request->image->path());
            $data = [
                "masinhvien"=> $request->masinhvien,
                "hoten" => $request->hoten,
                "email" => $request->email,
                "khoa" => $request->khoa,
                "id_lop"=>  $request->id_lop,
                "IMAGE" => $image
            ];
            $result =  $this->SinhVien->EditSinhVien($id,$data);
        }else{
            $data = [
                "masinhvien"=> $request->masinhvien,
                "hoten" => $request->hoten,
                "email" => $request->email,
                "khoa" => $request->khoa,
                "id_lop"=>  $request->id_lop,
            ];
            $result =  $this->SinhVien->EditSinhVien($id,$data);
        }
        return redirect()->route('sinhvien.showDanhSachSinhVien')->with('msg','Cập nhật sinh viên thành công');
    }
    public function delete($id){
        if(empty($id))
        {
            return view('Error.404');
        }
        $result = $this->SinhVien->Remove($id);
        if($result >= 0){
            return redirect()->route('sinhvien.showDanhSachSinhVien')->with('msg','Xóa lớp thành công');
        }
    }
}
