<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori')->get();
        return view('buku.index', compact('bukus'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('buku.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'judul' => 'required|string|unique:buku,judul|max:255',
            'deskripsi' => 'required|string',
            'penulis' => 'required|string',
            'cover' => 'required|image|mimes:jpg,jpeg,png,gif|max:8000',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        // Periksa status kategori
        $kategori = Kategori::find($request->kategori_id);

        // Jika kategori tidak aktif, kirimkan pesan error
        if ($kategori->status !== 'aktif') {
            return redirect()->back()->withErrors([
                'kategori_id' => 'Kategori yang dipilih tidak aktif. Pilih kategori dengan status aktif.',
            ])->withInput();
        }

        Buku::create($validated);

        return redirect()
            ->route('master.data.buku.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();
        return view('buku.edit', compact('buku', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'judul' => 'required|string|max:255|unique:buku,judul,' . $id . ',id_buku',
            'deskripsi' => 'required|string',
            'penulis' => 'required|string',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:8000',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        // Cek jika ada file cover yang diupload
        if ($request->hasFile('cover')) {
            try {
                // Menghapus file cover lama
                Storage::disk('public')->delete($buku->cover);
                // Menyimpan file cover yang baru
                $validated['cover'] = $request->file('cover')->store('covers', 'public');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['cover' => 'Gagal menyimpan file cover.'])->withInput();
            }
        }

        // Validasi status kategori
        $kategori = Kategori::find($request->kategori_id);

        // Jika kategori tidak aktif, kirimkan pesan error
        if ($kategori && $kategori->status !== 'aktif') {
            return redirect()->back()->withErrors([
                'kategori_id' => 'Kategori yang dipilih tidak aktif. Pilih kategori dengan status aktif.',
            ])->withInput();
        }

        // Update data buku
        $buku->update($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()
            ->route('master.data.buku.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        if ($buku->cover) {
            Storage::disk('public')->delete($buku->cover);
        }

        $buku->delete();

        return redirect()
            ->route('master.data.buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}