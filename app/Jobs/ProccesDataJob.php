<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProccesDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     */
    // public function __construct($data)
    // {
    //     $this->data = $data;
    // }

    /**
     * Execute the job.
     */
    // public function handle(): void
    // {
    //     Log::info("Memproses data: " . $this->data);
    //     sleep(2);
    //     Log::info("Selesai memproses data: " . $this->data);
    // }

    public $dataChunk;

    public function __construct($dataChunk)
    {
        $this->dataChunk = $dataChunk;
    }

    public function handle(){
        foreach ($this->dataChunk as $data) {
            Log::info("memproses item: " . $data);
            // Simulasi proses dengan sleep
            sleep(1);
        }
        Log::info("Selesai memproses chunk data.");
    }
}


