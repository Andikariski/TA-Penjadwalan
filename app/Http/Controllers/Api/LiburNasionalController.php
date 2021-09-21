<?php

namespace App\Http\Controllers\Api;

use App\Helpers\LiburNasionalHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LiburNasionalController extends Controller
{
    public function __construct()
    {
        $this->hariLibur = new LiburNasionalHelpers;
    }

    // Function untuk proses validasi tanggal API hari libur dengan tanggal yang dipilih
    public function liburNasional(Request $request)
    {
        $date = $request->get('date');
        $dataHariLibur = $this->hariLibur->hariLiburBerdasarkanTanggal($date);
        $data = $this->hariLibur->parseToAssoc($dataHariLibur);

        if (array_key_exists($date, $data)) {
            $hariLibur = $data[$date];

            if ($hariLibur['is_national']) {
                return response()->json([
                    'status' => 'ok',
                    'is_holiday' => true,
                    'name' => $hariLibur['name']
                ], Response::HTTP_OK);
            }
        }

        return response()->json([
            'status' => 'ok',
            'is_holiday' => false,
        ], Response::HTTP_OK);
    }
}
