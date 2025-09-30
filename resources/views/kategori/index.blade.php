@extends('layouts.main')

{{-- untuk styles khusus halaman tertentu --}}
@section('this-page-style')
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">
                Kategori
            </h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- Tombol Tambah menggunakan tag a -->
                <a href="{{ route('master.data.kategori.create') }}" class="btn btn-primary" role="button">
                    <i class="bi bi-plus-circle"></i>
                    Tambah
                </a>
            </div>
        </div>
        <div class="container mt-4">
            <!-- Tabel Daftar Kategori -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Aksi</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategoris as $kategori)
                        <tr>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('master.data.kategori.edit', $kategori->id_kategori) }}"
                                    class="btn btn-sm btn-outline-secondary">
                                    Edit
                                </a>
                                <!-- Tombol Hapus -->
                                <form action="{{ route('master.data.kategori.destroy', $kategori->id_kategori) }}"
                                    method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                            <td>{{ $kategori->nama }}</td>
                            <td>{{ $kategori->keterangan ?? 'Tidak ada keterangan' }}</td>
                            <td>
                                @if ($kategori->status == 'aktif')
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

{{-- untuk scripts khusus halaman tertentu --}}
@section('this-page-scripts')
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

        // Jika ada pesan error
        @if (session('error'))
            Swal.fire({
                title: 'Gagal!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'Coba Lagi',
                timer: 3000,
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
