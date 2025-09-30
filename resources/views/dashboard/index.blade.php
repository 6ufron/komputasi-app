@extends('layouts.main')
{{-- untuk styles khusus halaman tertentu --}}
@section('this-page-style')
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">
                Dashboard
            </h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- tempat button -->
            </div>
        </div>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($bukus as $buku)
                <div class="col">
                    <div class="card shadow-sm h-100 d-flex flex-column">
                        <!-- Gambar Cover Buku -->
                        <img src="{{ asset('storage/' . $buku->cover) }}" 
                             class="card-img-top"
                             alt="{{ $buku->judul }}"
                             style="height: 250px; object-fit: cover; width: 100%;" />
                
                        <div class="card-body d-flex flex-column">
                            <!-- Judul Buku dan Status -->
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">{{ $buku->judul }}</h5>
                                <!-- Menampilkan status -->
                                <span class="badge {{ $buku->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($buku->status) }}
                                </span>
                            </div>
                
                            <!-- Deskripsi Buku (dibatasi 100 karakter) -->
                            <p class="card-text">
                                {{ Str::limit($buku->deskripsi, 100, '...') }}
                            </p>
                
                            <!-- Bagian bawah (dengan mt-auto agar posisinya selalu di bawah) -->
                            <div class="mt-auto">
                                <!-- Penulis -->
                                <p class="card-text">
                                    <strong>Penulis:</strong> {{ $buku->penulis }}
                                </p>
                
                                <!-- Kategori -->
                                <p class="card-text">
                                    <strong>Kategori:</strong> {{ $buku->kategori->nama }}
                                </p>
                
                                <!-- Menu Edit, Show, dan Tanggal -->
                                <div class="d-flex justify-content-between align-items-center mt-3">

                                    <!-- Tombol Edit dan Show -->
                                    <div class="btn-group" role="group">
                                        
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('master.data.buku.edit', $buku->id_buku) }}" 
                                            class="btn btn-sm btn-outline-secondary">
                                            Edit
                                        </a>
                                
                                        <!-- Tombol Show -->
                                        <a href="/" 
                                            class="btn btn-sm btn-outline-secondary">
                                            Show
                                        </a>
                                    </div>
                
                                    <!-- Tanggal dan Jam -->
                                    <small class="text-body-secondary">
                                        {{ Carbon\Carbon::parse($buku->created_at)->format('j F, Y - H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                @endforeach
            </div>
        </div>
    </main>
@endsection

{{-- untuk scripts khusus halaman tertentu --}}
@section('this-page-scripts')
@endsection
