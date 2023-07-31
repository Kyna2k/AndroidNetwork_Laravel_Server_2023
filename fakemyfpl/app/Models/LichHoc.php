<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LichHoc extends Model
{
    use HasFactory;
    protected STRING $TABLE = "LICHHOC";
    public function AddAll($data){
        $result = DB::table($this->TABLE)->insert($data);
        return $result;
    }
    public function GetList(){
        $result = DB::table($this->TABLE)->get();
        return $result;
    }
    public function Get($page = 4){
        $result = DB::table($this->TABLE)
        ->join('LOP','LICHHOC.id_lop','=','LOP.ID')
        ->join('GIAOVIEN','LICHHOC.id_giaovien','=','GIAOVIEN.ID')
        ->join('MONHOC','LICHHOC.id_monhoc','=','MONHOC.ID')
        ->select('LICHHOC.*','LOP.malop as tenlop','GIAOVIEN.tengiaovien','MONHOC.tenmon')
        ->paginate($page);
        return $result;
    }
    public function GetLop($id_lop,$page = 4){
        $result = DB::table($this->TABLE)
        ->join('LOP','LICHHOC.id_lop','=','LOP.ID')
        ->join('GIAOVIEN','LICHHOC.id_giaovien','=','GIAOVIEN.ID')
        ->join('MONHOC','LICHHOC.id_monhoc','=','MONHOC.ID')
        ->where('LICHHOC.id_lop',$id_lop)
        ->select('LICHHOC.*','LOP.malop as tenlop','GIAOVIEN.tengiaovien','MONHOC.tenmon')
        ->paginate($page);
        return $result;
    }
    public function GetLopThi($id_lop,$page = 4){
        $result = DB::table($this->TABLE)
        ->join('LOP','LICHHOC.id_lop','=','LOP.ID')
        ->join('GIAOVIEN','LICHHOC.id_giaovien','=','GIAOVIEN.ID')
        ->join('MONHOC','LICHHOC.id_monhoc','=','MONHOC.ID')
        ->where('LICHHOC.id_lop',$id_lop)
        ->where('LICHHOC.loai','<>','NORMAL')
        ->select('LICHHOC.*','LOP.malop as tenlop','GIAOVIEN.tengiaovien','MONHOC.tenmon')
        ->paginate($page);
        return $result;
    }
    public function Add($data){
        $result = DB::table($this->TABLE)->insert($data);
        return $result;
    }
    public function GetEdit($id){
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
