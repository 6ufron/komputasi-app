<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="{{ asset('template/js/color-mode.js') }}"></script>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.122.0" />
    <link rel="icon" href="{{ asset('images/covers/logo.png') }}" type="image/png" />
    <title>Register - Komputasi</title>
    {{-- untuk styles --}}
    @include('layouts.styles')
    {{-- untuk styles khusus halaman tertentu --}}
    @yield('this-page-style')

    <style>
        html,
        body {
            height: 100%;
        }

        .form-signin {
            max-width: 330px;
            padding: 1rem;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"],
        .form-signin input[type="text"],
        .form-signin input[type="password"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .forgot-password {
            color: #000;
            text-decoration: none;
        }

        .forgot-password:hover {
            color: #0056b3;
            text-decoration: underline;
        }
    </style>
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">

    <main class="form-signin w-100 m-auto">
        <!-- Menampilkan pesan error umum jika ada -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <img class="mb-4" src="{{ asset('images/covers/logo.png') }}" alt="Logo"
                style="width: 100px; height: 100px;">
            <h1 class="h3 mb-3 fw-normal">Please sign up</h1>

            <!-- Input Name -->
            <div class="form-floating">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingName"
                    placeholder="Your Name" name="name" value="{{ old('name') }}" required autofocus>
                <label for="floatingName">Name</label>

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Email -->
            <div class="form-floating">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput"
                    placeholder="name@example.com" name="email" value="{{ old('email') }}" required>
                <label for="floatingInput">Email Address</label>

                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Password -->
            <div class="form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword"
                    placeholder="Password" name="password" required>
                <label for="floatingPassword">Password</label>
            </div>

            <!-- Confirm Password -->
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPasswordConfirm"
                    placeholder="Confirm Password" name="password_confirmation" required>
                <label for="floatingPasswordConfirm">Confirm Password</label>
            </div>

            <!-- Checkbox untuk Show/Hide Password -->
            <div class="form-check mt-3">
                <input type="checkbox" class="form-check-input" id="toggle-passwords">
                <label class="form-check-label" for="toggle-passwords">Show Passwords</label>
            </div>

            <button class="btn btn-primary w-100 py-2 mt-3" type="submit">
                Sign up
            </button>

            <!-- Tambahkan teks "Already have an account? Sign in" -->
            <div class="mt-3 text-left">
                <p class="text-muted">
                    Already have an account?
                    <a href="{{ route('login') }}" class="forgot-password">Sign in</a>
                </p>
            </div>
            
            <p class="mt-5 text-muted">
                &copy; {{ date('Y') }} KELAS KOMPUTASI_J
            </p>
        </form>
    </main>

    {{-- untuk scripts --}}
    @include('layouts.scripts')
    {{-- untuk scripts khusus halaman tertentu --}}
    @yield('this-page-scripts')
</body>

<script>
    // Script untuk mengubah type password saat checkbox diubah
    document.querySelector('#toggle-passwords').addEventListener('change', function () {
        const passwordInputs = document.querySelectorAll('#floatingPassword, #floatingPasswordConfirm');
        const showPassword = this.checked;

        // Toggle type untuk setiap input password
        passwordInputs.forEach(input => {
            input.setAttribute('type', showPassword ? 'text' : 'password');
        });
    });
</script>

</html>
