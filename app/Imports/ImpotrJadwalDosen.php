<?php

namespace App\Imports;

//use App\ImportJadwal;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Database\Eloquent\Model;
use App\Models\ImportJadwal;
use PhpParser\Node\Stmt\Return_;

class ImpotrJadwalDosen implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ImportJadwal([
            'nipy'      => $row[1],
            'senin'     => $row[2],
            'selasa'    => $row[3],
            'rabu'      => $row[4],
            'kamis'     => $row[5],
            'jumat'     => $row[6],
            'sabtu'     => $row[7],
            'jam_ke'    => $row[8],
        ]);
    }
}
