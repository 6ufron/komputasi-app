@extends('layouts.main')

{{-- Styles khusus halaman ini --}}
@section('this-page-style')
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">
                Buku
            </h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- Tombol Tambah -->
                <a href="{{ route('master.data.buku.create') }}" class="btn btn-primary" role="button">
                    <i class="bi bi-plus-circle"></i>
                    Tambah
                </a>
            </div>
        </div>

        <div class="container mt-4">
            <!-- Tabel Daftar Buku -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Aksi</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bukus as $buku)
                        <tr>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('master.data.buku.edit', $buku->id_buku) }}" 
                                    class="btn btn-sm btn-outline-secondary">
                                    {{-- <i class="fas fa-edit"></i>  --}}
                                    Edit
                                </a>
                                
                                <!-- Tombol Hapus -->
                                <form action="{{ route('master.data.buku.destroy', $buku->id_buku) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                        {{-- <i class="fas fa-trash-alt"></i>  --}}
                                        Hapus
                                    </button>
                                </form>
                            </td>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->kategori->nama ?? 'Tidak Ada Kategori' }}
                                <!-- Keterangan bahwa kategori telah dinonaktifkan -->
                                @if ($buku->kategori && $buku->kategori->status === 'nonaktif')
                                <span class="badge bg-warning text-dark">Non-Aktif</span>
                                @endif
                            </td>
                            <td>{{ $buku->penulis }}</td>
                            <td>
                                @if ($buku->status == 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Non-Aktif</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection

{{-- Scripts khusus halaman ini --}}
@section('this-page-scripts')
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Jika ada pesan sukses
        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK',
                timer: 2000,
                timerProgressBar: true,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        @endif
    </script>
@endsection
