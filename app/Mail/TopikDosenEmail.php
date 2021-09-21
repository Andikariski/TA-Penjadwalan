<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TopikDosenEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $type;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details,$type)
    {
        $this->details=$details;
        $this->type=$type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pengumanan Pengajuan Topik Dosen')->view('emails.topikDosen');
    }
}
