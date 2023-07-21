<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MonHoc;
use App\Models\Cloudinary;
class MonHocController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PAGE = 4;
    protected $MonHoc;
    private $cloudinary;
    public function __construct()
    {
        $this->MonHoc = new MonHoc();
        $this->cloudinary = new Cloudinary();
    }
    public function index()
    {
        //
        $list = $this->MonHoc->Get($this::PAGE);
        return view('monhoc.danhsachmonhoc',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('monhoc.addmonhoc');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $messages = [
            'required' => 'Trường :attribute vui lòng không để trống',
        ];
        $request -> validate([
            'mamon' => 'required|min:6',
            'tenmon' => 'required',
        ],$messages);
        $result = null;
        if($request->hasFile('hinhanh') != null)
        {
            $image = $this->cloudinary->upload($request->hinhanh->path());
            $data = [
                "mamon"=> $request->mamon,
                "tenmon" => $request->tenmon,
                "hinhanh" => $image
            ];
            $result =  $this->MonHoc->Add($data);
        }else{
            $data = [
                "mamon"=> $request->mamon,
                "tenmon" => $request->tenmon,
            ];
            $result =  $this->MonHoc->Add($data);
        }
        return redirect()->route('monhoc.index')->with('msg','Thêm môn học thành công');
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
        $monhoc = $this->MonHoc->GetEdit($id);
        if($monhoc === null){
            return view('Error.404');
        }
        return view('monhoc.editmonhoc',compact('monhoc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $messages = [
            'required' => 'Trường :attribute vui lòng không để trống',
        ];
        $request -> validate([
            'mamon' => 'required|min:6',
            'tenmon' => 'required',
        ],$messages);
        $result = null;
        if($request->hasFile('hinhanh') != null)
        {
            $image = $this->cloudinary->upload($request->hinhanh->path());
            $data = [
                "mamon"=> $request->mamon,
                "tenmon" => $request->tenmon,
                "hinhanh" => $image
            ];
            $result =  $this->MonHoc->Edit($id,$data);
        }else{
            $data = [
                "mamon"=> $request->mamon,
                "tenmon" => $request->tenmon,
            ];
            $result =  $this->MonHoc->Edit($id,$data);
        }
        return redirect()->route('monhoc.index')->with('msg','Cập nhật môn học thành công');
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
        $result = $this->MonHoc->Remove($id);
        if($result >= 0){
            return redirect()->route('monhoc.index')->with('msg','Xóa môn học thành công');
        }
    }
}
