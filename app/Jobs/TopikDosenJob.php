<?php

namespace App\Jobs;
use App\Models\MahasiswaRegisterTopikDosen;
use App\Models\Topikskripsi;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TopikDosenJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $mhs;
    public function __construct($mhs)
    {
        $this->mhs = $mhs;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // dd($this->mhs['id_topikskripsi']);
        $status=MahasiswaRegisterTopikDosen::where('id_topikskripsi',$this->mhs['id_topikskripsi'])
        ->pluck('status')
        ->all();

        $id=MahasiswaRegisterTopikDosen::where('id_topikskripsi',$this->mhs['id_topikskripsi'])
        ->pluck('id')
        ->all();

        
        
        

        if(in_array("Accept",$status) || in_array("Reject", $status)){
          
        
        }else{
            //query status rejct
            foreach($id as $user){
                $item=MahasiswaRegisterTopikDosen::where('id',$user)
            ->whereid_topikskripsi($this->mhs['id_topikskripsi'])
            ->update(
                ['status'=>'Reject']
            );
            }
        }
        
    }
}
