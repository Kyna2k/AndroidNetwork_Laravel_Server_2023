<?php

namespace App\Http\Controllers;

use App\Models\KhoaHocs;
use App\Models\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use function PHPUnit\Framework\isEmpty;

class KhoaHocController extends Controller{

    private $khoahoc;
    private $cloudinary;
    public function __construct()
    {
        $this->khoahoc = new KhoaHocs();
        $this->cloudinary = new Cloudinary();
    }
    public function index()
    {
        
    }
    //Hien thi danh sach khoa hoc
    public function showDanhSachKhoaHoc()
    {
       
        $list = $this->khoahoc->getDanhSach();
        
        
        return view('khoahoc.danhsachkhoahoc',compact('list'));
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
        $image = '';
        if($request->hasFile('image') != null)
        {
            $result = $this->cloudinary->upload($request->image->path());
            $image = $result;
        }
        $data = [
            $request->name,
            $request->TYPE,
            $request->description,
            $request->price,
            $image
        ];
        $this->khoahoc->addKhoaHoc($data);
        return redirect()->route('khoahoc.showDanhSachKhoaHoc')->with('msg','Thêm khóa học thành công');
    }
    public function getEditKhoaHoc($id){
        
        if(empty($id))
        {
            return view('Error.404');
        }else{
            $value= $this->khoahoc->getEdit($id);
            ;
            if(empty($value[0]))
            {
                return view('Error.404');
            }else{
                $khoahoc = $value[0];
                return view('khoahoc.editkhoahoc',compact('khoahoc'));
            }
        }
        // return dd($khoahoc);
        
    }
    public function editKhoaHoc(Request $request,$id){
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

        $image = '';
        if($request->hasFile('image') != null)
        {
            $result = $this->cloudinary->upload($request->image->path());
            $image = $result;
        }
        $data = [
            "NAME" => $request->name,
            "TYPE"=> $request->TYPE,
            "description"=> $request->description,
            "price"=> $request->price,
            "IMAGE" => $image,
            "id" => $id
        ];
        // return dd($data);
        $result = $this->khoahoc->editKhoaHoc($data);
        if($result >=0)
        {
            return redirect()->route('khoahoc.showDanhSachKhoaHoc')->with('msg','Sửa khóa học thành công');
        }
    }
    public function delete($id){
        if(empty($id))
        {
            return view('Error.404');
        }else{
            $result = $this->khoahoc->delateKhoaHoc($id);
            if($result === 1)
            {
                return redirect()->route('khoahoc.showDanhSachKhoaHoc')->with('msg','XóaA khóa học thành công');

            }
        }
    }
}