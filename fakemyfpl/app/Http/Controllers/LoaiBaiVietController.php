<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoaiBaiViet;
class LoaiBaiVietController extends Controller
{
    protected $LoaiBaiViet;
    /**
     * Display a listing of the resource.
     */
    const PAGE = 4;
    public function __construct()
    {
        $this->LoaiBaiViet = new LoaiBaiViet();
    }
    public function index()
    {
        //
        $list = $this->LoaiBaiViet->Get($this::PAGE);
        return view('loaibaiviet.danhsachloaibaiviet',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('loaibaiviet.addloaibaiviet');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $messages = [
            'required' => 'Trường :attribute vui lòng không để trống',
            'min' => 'Trường :attribute vui lòng nhập 7 kí tự',
        ];
        $request -> validate([
            'theloai' => 'required|min:7',
        ],$messages);
        $data = [
            'theloai' => $request->theloai
        ];
        $result = $this->LoaiBaiViet->Add($data);
        return redirect()->route('loaibaiviet.index')->with('msg','Thêm loại thành công');
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
        $loaibaiviet = $this->LoaiBaiViet->GetEdit($id);
        if($loaibaiviet === null){
            return view('Error.404');
        }
        return view('loaibaiviet.editloaibaiviet',compact('loaibaiviet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $messages = [
            'required' => 'Trường :attribute vui lòng không để trống',
            'min' => 'Trường :attribute vui lòng nhập 7 kí tự',
        ];
        $request -> validate([
            'theloai' => 'required|min:7',
        ],$messages);
        $data = [
            'theloai' => $request->theloai
        ];
        $result = $this->LoaiBaiViet->Edit($id,$data);
        return redirect()->route('loaibaiviet.index')->with('msg','Cập nhật loại thành công');
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
        $result = $this->LoaiBaiViet->Remove($id);
        if($result >= 0){
            return redirect()->route('loaibaiviet.index')->with('msg','Xóa loại thành công');
        }
    }
}
