<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\ImportDataMahasiswaModel;

class ImportDataMahasiswa implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        print_r($row);
        // return new ImportDataMahasiswaModel([
        //     'nim'     => $row[1],
        //     'nama'    => $row[2],
        //     'email'   => $row[3]
        // ]);
    }
}
