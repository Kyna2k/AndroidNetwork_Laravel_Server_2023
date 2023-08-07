<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BaiViet;
use App\Models\LoaiBaiViet;

class BaiVietController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PAGE = 4;
    protected $BaiViet,$LoaiBaiViet;
    public function __construct()
    {
        $this->BaiViet = new BaiViet();
        $this->LoaiBaiViet = new LoaiBaiViet();
    }

    public function index()
    {
        //
        $list = $this->BaiViet->GetDanhSach($this::PAGE);
        return view('baiviet.danhsachbaiviet',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $loaibaiviet = $this->LoaiBaiViet->GetList();
        return view('baiviet.addbaiviet',compact('loaibaiviet'));
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
            'tieude' => 'required',
            'noidung' => 'required',
            'id_loaibaiviet' => 'required',
            'tennguoidang' => 'required',

        ],$messages);
        $data = [
            'tieude' => $request->tieude,
            'noidung' => $request->noidung,
            'id_loaibaiviet' => $request->id_loaibaiviet,
            'tennguoidang' => $request->tennguoidang

        ];
        $result = $this->BaiViet->Add($data);
        $notifi = new GenToken();
            $data2 = [
                "message" => [
                    "topic" => "news",
                    "notification" => [
                        "title" => "Có tin mới",
                        "body" => "Hay click vào xem để kiểm tra thôngtin mới"
                    ]
                ]
            ];
           $ketqua =  $notifi->execute($notifi->getGoogleAccessToken(),$data2);
           dd($ketqua);
        return redirect()->route('baiviet.index')->with('msg','Thêm bài viết thành công');
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
        $loaibaiviet = $this->LoaiBaiViet->GetList();
        $baiviet = $this->BaiViet->Get($id);
        if($baiviet === null){
            return view('Error.404');
        }
     
        return view('baiviet.editbaiviet',compact('loaibaiviet','baiviet'));
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
            'tieude' => 'required',
            'noidung' => 'required',
            'id_loaibaiviet' => 'required',
            'tennguoidang' => 'required',

        ],$messages);
        $data = [
            'tieude' => $request->tieude,
            'noidung' => $request->noidung,
            'id_loaibaiviet' => $request->id_loaibaiviet,
            'tennguoidang' => $request->tennguoidang

        ];
        $result = $this->BaiViet->Edit($id,$data);
        return redirect()->route('baiviet.index')->with('msg','Cập nhật thành công');
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
        $result = $this->BaiViet->Remove($id);
        if($result >= 0){
            return redirect()->route('baiviet.index')->with('msg','Xóa lớp thành công');
        }
    }
}
