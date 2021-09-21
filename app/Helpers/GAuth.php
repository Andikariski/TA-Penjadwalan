<?php

namespace App\Helpers;

use Exception;
use Google_Client;
use Google_Service_Calendar;

class GAuth
{
    public $client;

    private $tokenPath;

    public function __construct()
    {
        $this->tokenPath = base_path() . '/config/Gtoken.json';
        $this->client = $this->getClient();
    }

    #Function untuk autentikasi token utama
    public function setToken()
    {
        if ($token = $this->getToken()) {
            $this->client->setAccessToken($token);
        }

        if ($this->client->isAccessTokenExpired()) {
            if ($rToken = $this->client->getRefreshToken()) {
                $this->client->fetchAccessTokenWithRefreshToken($rToken);
            } else {
                throw new Exception("You must run php artisan google:auth to generate the Google access token");
            }

            $this->setTokenFile($this->client->getAccessToken());
        }

        return true;
    }

    /**
     * Function untuk mengambil token
     * 1. Cek apakah token Gtoken.json sudah ada di file config
     * 2. Jika ada ambil token, jike belum return false
     * */
    public function getToken()
    {
        if (file_exists($this->tokenPath)) {
            $content = file_get_contents($this->tokenPath);
            return json_decode($content, true);
        }

        return false;
    }

    /**
     * Function untuk mendapatkan file token jika belum ada
     * 1. Jika token belum ada makan proses mendapatkan token
     * 2. Update token (refresh jika token expored)
     * */
    public function setTokenFile(array $data)
    {
        file_put_contents($this->tokenPath, json_encode($data));
        return true;
    }

    /**
     * Function untuk autentikasi client
     * 1. Set client dari class Google_Client -> Vendor
     * */
    private function getClient()
    {
        $client = new Google_Client([
            'application_name' => config('ggl.app_name'),
            'client_id' => config('ggl.client_id'),
            'client_secret' => config('ggl.client_secret'),
            'scopes' => [
                Google_Service_Calendar::CALENDAR,
                Google_Service_Calendar::CALENDAR_EVENTS,
            ],
            'redirect_uri' => config('ggl.redirect_uri'),
            'access_type' => 'offline',
            'prompt' => 'select_account consent'
        ]);

        return $client;
    }
}
