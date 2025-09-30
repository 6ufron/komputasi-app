@extends('layouts.main')

{{-- Styles khusus halaman ini --}}
@section('this-page-style')
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">
                Buku - Edit
            </h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- Tempat button jika diperlukan -->
            </div>
        </div>

        <div class="container mt-4">
            <form action="{{ route('master.data.buku.update', $buku->id_buku) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- <!-- Kategori (bebas pilih)-->
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori_id" name="kategori_id" required>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id_kategori }}" 
                                {{ $buku->kategori_id == $kategori->id_kategori ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}

                <!-- Hanya Kategori aktif yang bisa dipilih, dan ada validasi error jika memlilih yang nonaktif-->
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id_kategori }}" 
                                {{ $buku->kategori_id == $kategori->id_kategori ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                                {{ $kategori->status !== 'aktif' ? '(Nonaktif)' : '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Judul -->
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}" required>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $buku->deskripsi }}</textarea>
                </div>

                <!-- Penulis -->
                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $buku->penulis }}" required>
                </div>

                <!-- Cover Buku -->
                <div class="mb-3">
                    <label for="cover" class="form-label">Cover Buku</label>
                    <input type="file" class="form-control" id="cover" name="cover" accept="image/*" onchange="previewImage(event)" />
                    <!-- Preview Cover -->
                    <div class="mt-3" id="cover-preview" style="display: {{ $buku->cover ? 'block' : 'none' }}">
                        <label for="cover" class="form-label">Pratinjau Cover:</label>
                        <img id="cover-image" src="{{ asset($buku->cover) }}" alt="Cover Preview" class="img-fluid" style="max-width: 200px" />
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="aktif" {{ $buku->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ $buku->status == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                </div>

                <!-- Tombol Update -->
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Update Buku
                </button>
                <a href="{{ route('master.data.buku.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Batal
                </a>
            </form>
        </div>
    </main>
@endsection

{{-- Scripts khusus halaman ini --}}
@section('this-page-scripts')
    <script>
        // Fungsi untuk pratinjau gambar
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                const imagePreview = document.getElementById("cover-image");
                const previewContainer = document.getElementById("cover-preview");
                imagePreview.src = reader.result;
                previewContainer.style.display = "block";
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection