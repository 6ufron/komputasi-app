@extends('layouts.main')

{{-- untuk styles khusus halaman tertentu --}}
@section('this-page-style')
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">
                Kategori - Edit
            </h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- tempat button -->
            </div>
        </div>
        <div class="container mt-4">
            <!-- Form untuk mengupdate kategori -->
            <form action="{{ route('master.data.kategori.update', $kategori->id_kategori) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Input Nama Kategori -->
                <div class="mb-3">
                    <label for="category" class="form-label">Kategori</label>
                    <input type="text" class="form-control" id="category" name="nama"
                        value="{{ old('nama', $kategori->nama) }}" required />
                </div>

                <!-- Text Area untuk Keterangan -->
                <div class="mb-3">
                    <label for="description" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="description" name="keterangan" rows="3" required>{{ old('keterangan', $kategori->keterangan) }}</textarea>
                </div>

                <!-- Select untuk Status Kategori -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="aktif" {{ old('status', $kategori->status) == 'aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>
                        <option value="nonaktif" {{ old('status', $kategori->status) == 'nonaktif' ? 'selected' : '' }}>
                            Non-Aktif
                        </option>
                    </select>
                </div>

                <!-- Tombol Submit untuk Perbarui Data -->
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-sync-alt"></i>
                        Perbarui
                    </button>
                    <a href="{{ route('master.data.kategori.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </main>
@endsection

{{-- untuk scripts khusus halaman tertentu --}}
@section('this-page-scripts')
@endsection
