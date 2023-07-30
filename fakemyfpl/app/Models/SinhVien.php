<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SinhVien extends Model
{
    use HasFactory;
    protected String $TABLE = "SINHVIEN";
    public function GetDanhSach($page = null){
        $result = DB::table($this->TABLE)->leftJoin('LOP','SINHVIEN.id_lop','=','LOP.ID')->select('SINHVIEN.*','Lop.malop')->paginate($page);
        return $result;
    }
    public function AddSinhVien($data){
        $result = DB::table($this->TABLE)->insert($data);
        return $result;
    }
    public function GetSinhVien($id){
        $result = DB::table($this->TABLE)->where('id',$id)->first();
        return $result;
    }
    public function EditSinhVien($id, $data){
        $result = DB::table($this->TABLE)->where('id',$id)->update($data);
        return $result;
    }
    public function Remove($id){
        $result = DB::table($this->TABLE)->where('id',$id)->delete();
        return $result;
    }


    //Login 
    public function login($email){
        $result = DB::table($this->TABLE)->where('email',$email)->select('id','masinhvien','hoten','khoa','IMAGE','id_lop')->first();
        return $result;
    }
}
