<?php
namespace App\Imports;

use App\Models\LichHoc;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
class LichHocImport implements ToCollection
{
    public $id_lop,$id_giaovien,$id_monhoc;
    public function __construct($id_lop,$id_giaovien,$id_monhoc)
    {
        $this->id_lop = $id_lop;
        $this->id_monhoc = $id_monhoc;
        $this->id_giaovien = $id_giaovien;
    }
    public function collection(Collection $rows)
    {
        $result = [];
        foreach ($rows as $row) 
        {   
            
            array_push($result,[
                "id_lop" => $this->id_lop,
                "id_giaovien" =>$this->id_giaovien,
                "id_monhoc"=>$this->id_monhoc,
                "phonghoc"=>$row[0],
                "thoigian"=>Date::excelToDateTimeObject($row[1]),
                "loai"=>$row[2]
            ]);
        }
        $lichhoc = new LichHoc();
        $lichhoc->AddAll($result);
    }
}