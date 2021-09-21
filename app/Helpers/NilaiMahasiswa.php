<?php

namespace App\Helpers;

class NilaiMahasiswa
{
    public function nilai_semprop($countArr, $value)
    {
        $temp = 0;
        for ($i = 0; $i < $countArr; $i++) {
            $temp = $temp + $value[$i];
        }

        return $temp * 0.5;
    }

    public function nilaiPendadaran($countArr, $value, $bobot)
    {
        $temp = 0;
        for ($i = 0; $i < $countArr; $i++) {
            $temp = $temp + $value[$i] * $bobot[$i];
        }
        return $temp;
    }
}
