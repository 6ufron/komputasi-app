@extends('layouts.main')

{{-- untuk styles khusus halaman tertentu --}}
@section('this-page-style')
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">
                Profil - Update
            </h1>
        </div>
        <div class="container mt-4">
            <form action="{{ route('profil.update', Auth::user()->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Untuk method PUT jika melakukan update -->

                <!-- Email -->
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', Auth::user()->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password Sekarang -->
                <div class="mb-3">
                    <label for="password_sekarang">Password Sekarang</label>
                    <input type="password" name="password_sekarang" id="password_sekarang"
                        class="form-control @error('password_sekarang') is-invalid @enderror">
                    @error('password_sekarang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password Baru -->
                <div class="mb-3">
                    <label for="password_baru">Password Baru</label>
                    <input type="password" name="password_baru" id="password_baru"
                        class="form-control @error('password_baru') is-invalid @enderror">
                    @error('password_baru')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Konfirmasi Password Baru -->
                <div class="mb-3">
                    <label for="password_baru_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" name="password_baru_confirmation" id="password_baru_confirmation"
                        class="form-control @error('password_baru_confirmation') is-invalid @enderror">
                    @error('password_baru_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Checkbox untuk Show/Hide All Passwords -->
                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="toggle-passwords">
                        <label class="form-check-label" for="toggle-passwords">Tampilkan Semua Password</label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-sync-alt"></i>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('profil.index') }}" class="btn btn-secondary">
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
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // SweetAlert animations
        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK',
                timer: 2000,
                timerProgressBar: true
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: 'Kesalahan!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'OK',
                timer: 3000,
                timerProgressBar: true
            });
        @endif

        // Toggle all passwords visibility
        document.querySelector('#toggle-passwords').addEventListener('change', function () {
            const inputs = document.querySelectorAll('#password_sekarang, #password_baru, #password_baru_confirmation');
            const showPassword = this.checked;

            // Toggle type for each input
            inputs.forEach(input => {
                input.setAttribute('type', showPassword ? 'text' : 'password');
            });
        });
    </script>
@endsection
