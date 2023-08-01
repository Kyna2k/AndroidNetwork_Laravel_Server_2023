<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LoaiBaiViet extends Model
{
    use HasFactory;
    protected String $TABLE = "LOAIBAIVIET";
    public function GetList(){
        $result = DB::table($this->TABLE)->get();
        return $result;
    }
    public function Get($page = 10){
        $result = DB::table($this->TABLE)->paginate($page);
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
