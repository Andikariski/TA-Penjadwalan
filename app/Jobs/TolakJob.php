<?php

namespace App\Jobs;
use App\Models\Topikskripsi;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TolakJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $topik;
    public function __construct($topik)
    {
        $this->topik = $topik;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $status=Topikskripsi::whereid($this->topik->id)
        ->pluck('status')
        ->first();

        if($status!="Accept"){
            Topikskripsi::whereid($this->topik->id)
        ->update(['status'=>'Reject']);
        }

        

    }
}
