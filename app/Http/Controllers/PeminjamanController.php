<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Menampilkan daftar peminjaman.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Cek role pengguna
        if (auth()->user()->role === 'pengguna') {
            // Jika role adalah "pengguna", ambil data berdasarkan user_id yang login
            $peminjaman = Peminjaman::where('user_id', auth()->id())->get();
        } else {
            // Jika role adalah "admin" atau "super admin", ambil semua data
            $peminjaman = Peminjaman::all();
        }

        // Tampilkan view dengan data peminjaman
        return view('peminjaman.index', compact('peminjaman'));
    }

    /**
     * Menyimpan data peminjaman.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'buku_id' => 'required|exists:bukus,id_buku', // Validasi buku harus ada di tabel bukus
        ]);

        // Simpan data peminjaman
        Peminjaman::create([
            'user_id' => auth()->id(), // ID user yang sedang login
            'buku_id' => $request->buku_id, // ID buku yang dipinjam
            'tanggal_pinjam' => now(), // Tanggal saat ini
            'tanggal_kembali' => null, // Awalnya null, bisa diupdate nanti
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard.index')->with('success', 'Buku berhasil dipinjam.');
    }
}
