<?php

namespace App\Imports;

use App\Models\LichHoc;
use Maatwebsite\Excel\Concerns\ToModel;

class LichHocImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new LichHoc([
            //
        ]);
    }
}
