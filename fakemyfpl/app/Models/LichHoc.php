<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LichHoc extends Model
{
    use HasFactory;
    public function AddAll($data){
        $result = DB::insert($data);
        return $result;
    }
}
