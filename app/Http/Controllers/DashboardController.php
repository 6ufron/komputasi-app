<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil semua buku dari kategori terkait


        // Mengambil semua buku dari database
        // $bukus = Buku::with('kategori')->get();

        // Hanya mengambil buku dengan status aktif
        // $bukus = Buku::with('kategori')->where('status', 'aktif')->get();

        // Mengambil semua buku yang aktif, diurutkan berdasarkan tanggal terbaru
        $bukus = Buku::with('kategori')->where('status', 'aktif')->orderBy('created_at', 'DESC')->get();

        // Mengambil semua buku yang non aktif, diurutkan berdasarkan tanggal terbaru
        // $bukus = Buku::with('kategori')->where('status', 'nonaktif')->orderBy('created_at', 'DESC')->get();
        
        // Mengambil hanya 2 (kustom) buku terbaru dengan status 'aktif', diurutkan berdasarkan tanggal pembuatan
        // $bukus = Buku::with('kategori') // Mengambil relasi kategori untuk setiap buku
        //     ->where('status', 'aktif') // Menyaring buku dengan status aktif
        //     ->orderBy('created_at', 'DESC') // Mengurutkan berdasarkan tanggal pembuataan terbaru
        //     ->get() // Mengambil semua data yang sesuai dengan kondisi diatas
        //     ->take(3); // Membatasi hanya 2 buku terbaru yang diambil
    
        // Mengembalikan tampilan dengan data buku
        return view('dashboard.index', compact('bukus'));

        //Query sql vs ORM Laravel (elequent)

        // $query = Buku::get(); // = Query : SELECT * FROM BUKU

        // $query = Buku::select('id_buku', 'judul', 'penulis', 'status')->get(); // = Query : SELECT id_buku, judul, penulis, status FROM buku;

        // $query = Buku::select('id_buku', 'kategori_id', 'judul', 'penulis', 'status')->with('kategori')->get(); // = Query : SELECT buku.id_buku, buku.judul, buku.penulis, buku.status, kategori.nama AS nama_kategori FROM buku JOIN kategori ON kategori.id_kategori = buku.kategori_id;

        $query = Buku::orderBy('created_at', 'DESC')->get()
            ->take(2)
            ->map(function ($b) {
                return [
                    'id_buku' => $b->id_buku,
                    'judul' => $b->judul,
                    'penulis' => $b->penulis,
                    'status' => $b->status,
                    'deskripsi' => collect(explode(' ', $b->deskripsi))->take(5)->implode(' ') . '...',
                    'kategori' => $b->kategori->nama,
                    'tanggal' => Carbon::parse($b->created_at)->translatedFormat('d F Y'),
                ];
            });
            
        return $query;
    }    
}


// public function index()
// {
//     // Mengambil hanya 2 buku terbaru dengan status 'aktif', diurutkan berdasarkan tanggal pembuatan
//     $query = Buku::with('kategori') // Mengambil relasi kategori untuk setiap buku
//         ->where('status', 'aktif') // Menyaring buku dengan status aktif
//         ->orderBy('created_at', 'DESC') // Mengurutkan berdasarkan tanggal pembuatan terbaru
//         ->limit(2) // Membatasi hanya 2 buku yang diambil
//         ->get() // Mengambil data dari database
//         ->map(function ($b) {
//             return [
//                 'id_buku' => $b->id_buku,
//                 'judul' => $b->judul,
//                 'penulis' => $b->penulis,
//                 'status' => $b->status,
//                 'deskripsi' => collect(explode(' ', $b->deskripsi))->take(5)->implode(' ') . '...',
//                 'kategori' => $b->kategori->nama,
//                 'tanggal' => Carbon::parse($b->created_at)->translatedFormat('d F Y'),
//             ];
//         });

//     // Kembalikan data ke view
//     return view('dashboard.index', compact('query'));
// }
