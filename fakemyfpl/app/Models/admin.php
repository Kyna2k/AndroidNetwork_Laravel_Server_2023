<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class admin extends Model
{
    protected String $TABLE = "ADMIN";
    use HasFactory;
    public function Login($data) {
        $result = DB::table($this->TABLE)->where('username', '=',$data["username"])->first();
        return $result;
    }
}
