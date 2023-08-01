<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaiViet extends Model
{
    use HasFactory;
    protected String $TABLE = "BAIVIET";
    public function GetDanhSach($page = 5){
        $result = DB ::table($this->TABLE)->leftJoin('LOAIBAIVIET','BAIVIET.id_loaibaiviet','=','LOAIBAIVIET.ID')->select('BAIVIET.*','LOAIBAIVIET.theloai')->paginate($page);
        return $result;
    }
    public function GetDanhSachTheoLoai($id_loai,$page = 3){
        $result = DB ::table($this->TABLE)->leftJoin('LOAIBAIVIET','BAIVIET.id_loaibaiviet','=','LOAIBAIVIET.ID')->where('BAIVIET.id_loaibaiviet',$id_loai)->select('BAIVIET.*','LOAIBAIVIET.theloai')->paginate($page);
        return $result;
    }
    public function Add($data){
        $result = DB::table($this->TABLE)->insert($data);
        return $result;
    }
    public function Get($id){
        $result = DB::table($this->TABLE)->where('id',$id)->first();
        return $result;
    }
    public function Edit($id, $data){
        $result = DB::table($this->TABLE)->where('id',$id)->update($data);
        return $result;
    }
    public function Remove($id){
        $result = DB::table($this->TABLE)->where('id',$id)->delete();
        return $result;
    }
}
