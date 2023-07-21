<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lop;
class LopController extends Controller
{
    protected $Lop;
    /**
     * Display a listing of the resource.
     */
    const PAGE = 4;
    public function __construct()
    {
        $this->Lop = new Lop();
    }
    public function index()
    {
        $list = $this->Lop->Get($this::PAGE);
        return view('lop.danhsachlop',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('lop.addlop');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Trường :attribute vui lòng không để trống',
            'min' => 'Trường :attribute vui lòng nhập 7 kí tự',
        ];
        $request -> validate([
            'malop' => 'required|min:7',
        ],$messages);
        $data = [
            'malop' => $request->malop
        ];
        $result = $this->Lop->Add($data);
        return redirect()->route('lop.index')->with('msg','Thêm lớp thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(empty($id))
        {
            return view('Error.404');
        }
        $lop = $this->Lop->GetEdit($id);
        if($lop === null){
            return view('Error.404');
        }
        return view('lop.editlop',compact('lop'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => 'Trường :attribute vui lòng không để trống',
            'min' => 'Trường :attribute vui lòng nhập 7 kí tự',
        ];
        $request -> validate([
            'malop' => 'required|min:7',
        ],$messages);
        $data = [
            'malop' => $request->malop
        ];
        $result = $this->Lop->Edit($id,$data);
        if($result) {
            return redirect()->route('lop.index')->with('msg','Cập nhật lớp thành công');
        }
        return "Lỗi cập nhật";
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
        $result = $this->Lop->Remove($id);
        if($result >= 0){
            return redirect()->route('lop.index')->with('msg','Xóa lớp thành công');
        }
    }
}
