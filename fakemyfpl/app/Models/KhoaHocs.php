<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KhoaHocs extends Model
{
    use HasFactory;
    protected STRING $Table = "KHOAHOC";

    public function getDanhSach($page = null)
    {
        //Phai dung ki tu viet hoa
        // //RAW QUERY / được build từ PD
        // $query = "SELECT * FROM $this->Table";
        // $list = DB::select($query);
        //Query builder
        //Sử dụng statement để sử dụng bất cứ câu lệnh nào cũng đc
        $list = DB::table($this->Table)->paginate($page);
        return $list;
    }
    public function addKhoaHoc($data){
        $query = "INSERT INTO $this->Table(NAME,TYPE,description,price,IMAGE) values (?,?,?,?,?)";
        $result = DB::insert($query,$data);
        return $result;
    }
    public function getEdit($id)
    {
        $query = "SELECT * FROM $this->Table where id=$id";
        $khoahoc = DB::select($query);
        return  $khoahoc;
    }
    public function editKhoaHoc($data){
        $query ="";
        if($data["IMAGE"] !=="")
        {
            $query = 
            "UPDATE $this->Table
                SET NAME = :NAME,
                    TYPE = :TYPE,
                    description = :description,
                    price = :price,
                    IMAGE = :IMAGE
                    WHERE id = :id";
        }else{
            unset($data["IMAGE"]);
            $query = 
            "UPDATE $this->Table
                SET NAME = :NAME,
                    TYPE = :TYPE,
                    description = :description,
                    price = :price
                    WHERE id = :id";
        }
         $result = DB::update($query,$data);
         return $result;
    }
    public function delateKhoaHoc($id){
        $query = "DELETE FROM $this->Table WHERE id=:id";
        $result = DB::delete($query,["id"=>$id]);
        return $result;
    }
}
