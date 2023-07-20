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
        $result = DB::table($this->TABLE)->paginate($page);
        return $result;
    }
}
