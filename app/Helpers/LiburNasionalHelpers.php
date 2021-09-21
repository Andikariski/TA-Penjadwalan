<?php

namespace App\Helpers;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Storage;

class LiburNasionalHelpers
{
    protected $apiUrl = 'https://api-harilibur.vercel.app/api';

    protected $contentSize = 5120;

    public function __construct()
    {
        $this->client = new GuzzleClient([
            'base_uri' => $this->apiUrl
        ]);
    }

    /*
    ----------------------------
    Get Holiday Data
    ----------------------------
    | Return holidays data from the local file (if exist), we use
    | local file to cache data and increase the loading speed.
    */

    #Function get data from API by date in selected and save to local storage
    public function hariLiburBerdasarkanTanggal($date)
    {
        $date = $this->dateParser($date);
        $query = '?month=' . $date['month'] . '&year=' . $date['year'];
        $path = 'local/holidays/holiday' . $date['year'] . $date['month'] . '.json';

        if (!Storage::exists($path)) {
            $content = $this->client->request('GET', $query)->getBody()->read($this->contentSize);
            $content = $this->parseContent($content);
            Storage::put($path, $content);
        } else {
            $content = Storage::get($path);
        }

        return json_decode($content);
    }

    #Function Conversi object from API to Array[]
    public function parseToAssoc(array $holidays)
    {
        $parsed = [];

        foreach ($holidays as $holiday) {
            $parsed[$holiday->holiday_date] = [
                'name' => $holiday->holiday_name,
                'is_national' => $holiday->is_national_holiday
            ];
        }

        return $parsed;
    }

    #Function Memecah tanggal yang dipilih pada calendar
    private function dateParser($date)
    {
        $exp = explode('-', $date);
        if (count($exp) <= 1) $exp[0] = null;

        return [
            'year' => $exp[0] ?? date('Y'),
            'month' => $exp[1] ?? date('m'),
            'day' => $exp[2] ?? date('d')
        ];
    }

    #Function parse data content
    private function parseContent(String $content)
    {
        $holidays = json_decode($content);
        $parsed = [];

        foreach ($holidays as $holiday) {
            $date = $holiday->holiday_date;
            $holiday->holiday_date = $this->validDasi($date);
            $parsed[] = $holiday;
        }

        return json_encode($parsed);
    }

    #Function Menambah 0 di tanggal yang < 10 pada API untuk disesuaikan dengan tanggal pada calendar penjadwalan
    private function validDasi(String $date)
    {
        $exp = explode('-', $date);

        if (intval($exp[2]) < 10) {
            $exp[2] = '0' . $exp[2];
        }

        return implode('-', $exp);
    }
}
