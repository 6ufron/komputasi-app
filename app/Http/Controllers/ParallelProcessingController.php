<?php

namespace App\Http\Controllers;

use App\Jobs\ProccesDataJob;
use Illuminate\Http\Request;

class ParallelProcessingController extends Controller
{
    public function processlargetask(){
        // Data besar yang perlu diproses
        $dataChunk = $this->splitDatainfoChunks(range(1, 100)); // Pecah menjadi bebrapa

        // Dispatch setiap chunk data menjadi job baru
        foreach ($dataChunk as $chunk) {
            ProccesDataJob::dispatch($chunk);
        }

        return response()->json(['message' => 'Job diproses secara paralel.']);
    }

    private function splitDataInfoChunks($data, $chunkSize = 10){
        return array_chunk($data, $chunkSize); // Memecah data menjadi beberapa kecil
    }
}


