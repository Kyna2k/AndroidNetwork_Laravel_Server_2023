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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
            return redirect().route('lichhoc.index');
        }
        return 'NGANH L';
    }
}
