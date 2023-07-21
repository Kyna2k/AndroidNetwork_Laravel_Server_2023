<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiaoVien;
use App\Models\Cloudinary;
class GiaoVienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PAGE = 4;
    protected $GiaoVien;
    private $cloudinary;

    public function __construct()
    {
        $this->GiaoVien = new GiaoVien();
        $this->cloudinary = new Cloudinary();
    }

    public function index()
    {
        //
     
        $list = $this->GiaoVien->Get($this::PAGE);
        return view('giaovien.danhsachgiaovien',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
        return view('giaovien.addgiaovien');
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
            'tengiaovien' => 'required|min:6',
        ],$messages);
        $result = null;
        if($request->hasFile('hinhanh') != null)
        {
            $image = $this->cloudinary->upload($request->hinhanh->path());
            $data = [
                "tengiaovien"=> $request->tengiaovien,
                "hinhanh" => $image
            ];
            $result =  $this->GiaoVien->Add($data);
        }else{
            $data = [
                "tengiaovien"=> $request->tengiaovien,
            ];
            $result =  $this->GiaoVien->Add($data);
        }
        return redirect()->route('giaovien.index')->with('msg','Thêm giáo viên thành công');
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
        $giaovien = $this->GiaoVien->GetEdit($id);
        if($giaovien === null){
            return view('Error.404');
        }
        return view('giaovien.editgiaovien',compact('giaovien'));
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
            'tengiaovien' => 'required|min:6',
        ],$messages);
        $result = null;
        if($request->hasFile('hinhanh') != null)
        {
            $image = $this->cloudinary->upload($request->hinhanh->path());
            $data = [
                "tengiaovien"=> $request->tengiaovien,
                "hinhanh" => $image
            ];
            $result =  $this->GiaoVien->Edit($id,$data);
        }else{
            $data = [
                "tengiaovien"=> $request->mamon,
            ];
            $result =  $this->GiaoVien->Edit($id,$data);
        }
        return redirect()->route('giaovien.index')->with('msg','Thêm giáo viên thành công');
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
        $result = $this->GiaoVien->Remove($id);
        if($result >= 0){
            return redirect()->route('giaovien.index')->with('msg','Xóa giáo viên thành công');
        }
    }
}
