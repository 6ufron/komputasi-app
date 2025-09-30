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
                User
            </h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- Tombol Tambah -->
                <a href="{{ route('master.data.user.create') }}" class="btn btn-primary" role="button">
                    <i class="fas fa-user-plus"></i> 
                    Tambah
                </a>
            </div>
        </div>

        <div class="container mt-4">
            <!-- Tabel Daftar User -->
            <table class="table table-striped">
            {{-- <table class="table table-hover table-bordered"> --}}
                <thead class="table-light">
                    <tr>
                        <th scope="col">Aksi</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('master.data.user.edit', $user->id) }}" 
                                   class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                
                                <!-- Tombol Hapus -->
                                <form action="{{ route('master.data.user.destroy', $user->id) }}" 
                                      method="POST" 
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->role == 'super_admin')
                                    <span class="badge bg-danger">Super Admin</span>
                                @elseif ($user->role == 'admin')
                                    <span class="badge bg-success">Admin</span>
                                @else
                                    <span class="badge bg-primary">Pengguna</span>
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
