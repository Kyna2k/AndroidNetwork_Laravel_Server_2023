<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

class Cloudinary extends Model {
    use HasFactory;
    private $upload;
    public function __construct()
    {
        Configuration::instance('cloudinary://363347973346831:Wlj-qgZs2RSZT029z3Enc8svx-M@dptqmou33?secure=true');
        $this->upload = new UploadApi();
    }
    public function upload($url)
    {
        $res = $this->upload->upload($url, [
            'use_filename' => TRUE,
            'overwrite' => TRUE])["secure_url"];
        return $res;
    }
}