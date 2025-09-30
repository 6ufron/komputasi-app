<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data kategori
        $kategoris = Kategori::all();

        // Tampilkan view dengan data kategori
        return view('kategori.index', compact('kategoris'));

        // Contoh dengan pagination (jika diperlukan)
        // $kategoris = Kategori::paginate(10);
        // return view('kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form untuk membuat kategori baru
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kategori',
            'keterangan' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        // Pastikan status valid
        if (!in_array($request->status, ['aktif', 'nonaktif'])) {
            return redirect()->back()->withErrors(['status' => 'Status tidak valid']);
        }

        // Simpan data kategori baru
        Kategori::create($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()
            ->route('master.data.kategori.index')
            ->with('success', 'Kategori berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Belum diimplementasikan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Cari kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // Tampilkan form untuk mengedit kategori
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kategori,nama,' . $id . ',id_kategori',
            'keterangan' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        // Cari kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // Update kategori dengan data baru
        $kategori->update($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()
            ->route('master.data.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        //cek apakah kategori memiliki relasi dengan buku
        if ($kategori->buku()->count() > 0) {
            //Jika ada buku yang terhubung dengan kategori ini, kembalikan pesan error
            return redirect()->route('master.data.kategori.index')
                ->with('error', 'Kategori ini tidak bisa dihapus karena memiliki relasi dengan buku.');
        }

        // Hapus kategori jika tidak ada relasi dengan buku
        $kategori->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()
            ->route('master.data.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    // Contoh middleware untuk memastikan hanya pengguna dengan hak akses tertentu yang dapat mengakses resource ini.
    // public function __construct()
    // {
    //     $this->middleware('can:create,kategori');
    // }
}
