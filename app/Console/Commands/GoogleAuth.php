<?php

namespace App\Console\Commands;

use App\Helpers\GAuth;
use Google_Client;
use Google_Service_Calendar;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class GoogleAuth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google:auth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get access token from Google OAuth';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->GAuth = new GAuth;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */

    /**
     * Function untuk mendapatkan token Google calendar 
     * Cara kerja Function
     * 1. Function memeriksa apakah dalam project sudah ada token belum
     * 2. Kemudian memeriksa apakah token sudah expired atau belum, jika sudah maka akan proses getRefresh token
     * 3. Jika belum memiliki token maka akan menjalankan fungsi generate akses token lewat cmd, kemudian ke link Browser
     */
    public function handle()
    {
        $client = $this->GAuth->client;

        if ($token = $this->GAuth->getToken()) {
            $client->setAccessToken($token);
        }

        if ($client->isAccessTokenExpired()) {
            if ($rToken = $client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($rToken);
            } else {
                $this->info("Open the following link in your browser: ");
                $this->comment($client->createAuthUrl());
                $code = $this->ask('Enter verification code: ');
                $accToken = $client->fetchAccessTokenWithAuthCode($code);
                $client->setAccessToken($accToken);

                if (array_key_exists('error', $accToken)) {
                    return $this->error('Google access token is invalid, try again');
                }
            }

            $this->GAuth->setTokenFile($client->getAccessToken());
        }

        $this->info('Google access token created successfully');
        return 0;
    }
}
