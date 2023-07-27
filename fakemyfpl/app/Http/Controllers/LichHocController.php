<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\LichHocImport;
use Illuminate\Http\Request;
use App\Models\GiaoVien;
use App\Models\LichHoc;
use App\Models\MonHoc;
use App\Models\Lop;
use Maatwebsite\Excel\Facades\Excel;
class LichHocController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $GiaoVien,$MonHoc,$Lop,$LichHoc;
    const PAGE = 4;
    public function __construct()
    {
        $this->GiaoVien = new GiaoVien();
        $this->MonHoc = new MonHoc();
        $this->Lop = new Lop();
        $this->LichHoc = new LichHoc();
    }
    public function index()
    {
        //
        $list = $this->LichHoc->Get($this::PAGE);
        return view('lichhoc.danhsachlichhoc',compact('list'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
       
        if(empty($id))
        {
            return view('Error.404');
        }
        $lichhoc = $this->LichHoc->GetEdit($id);
        if($lichhoc === null){
            return view('Error.404');
        }
        $listlop = $this->Lop->GetList();
        $listgiaovien = $this->GiaoVien->GetList();
        $listmonhoc = $this->MonHoc->GetList();
        return view('lichhoc.editlichhoc',compact('lichhoc','listlop','listgiaovien','listmonhoc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        if(empty($id))
        {
            return view('Error.404');
        }
        $data = [
            "id_lop" => $request->id_lop,
            "id_giaovien" =>$request->id_giaovien,
            "id_monhoc"=>$request->id_monhoc,
            "phonghoc"=>$request->phonghoc,
            "thoigian"=>$request->thoigian,
            "loai"=>$request->loai
        ];
        $result = $this->LichHoc->edit($id,$data);
        return redirect()->route('lichhoc.index')->with('msg','Cập nhật lịch học thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        if(empty($id))
        {
            return view('Error.404');
        }
        $result = $this->LichHoc->Remove($id);
        if($result >= 0){
            return redirect()->route('lichhoc.index')->with('msg','Xóa lichhoc thành công');
        }
    }
    public function gettooladdlichhoc(){
        $listlop = $this->Lop->GetList();
        $listgiaovien = $this->GiaoVien->GetList();
        $listmonhoc = $this->MonHoc->GetList();
        return view('lichhoc.addlichhoctheolop',compact('listlop','listgiaovien','listmonhoc'));
    }
    public function tooladdlichhoc(Request $request){
        $result =  Excel::import(new LichHocImport($request->id_lop,$request->id_giaovien,$request->id_monhoc),$request->data);
        if($result != null){
            return redirect()->route('lichhoc.index');
        }
        return 'NGANH L';
    }
}
