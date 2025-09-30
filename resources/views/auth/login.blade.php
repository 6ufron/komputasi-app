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
    <title>Login - Komputasi</title>
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

        .form-signin input[type="email"] {
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

        .text-muted {
            margin-left: 10px;
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

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <img class="mb-4"
                src="{{ asset('images/covers/logo.png') }}" alt="Logo"
                style="width: 100px; height: 100px;">
            <h1 class="h3 mb-3 fw-normal">
                Please sign in
            </h1>

            <!-- Input Email -->
            <div class="form-floating">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput"
                    placeholder="name@example.com" name="email" value="{{ old('email') }}">
                <label for="floatingInput">Email address</label>

                <!-- Menampilkan error untuk email -->
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Password -->
            <div class="form-floating position-relative">
                <input type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       id="floatingPassword" 
                       placeholder="Password" 
                       name="password">
                <label for="floatingPassword">Password</label>
                
                <!-- Ikon untuk hide/show password -->
                <span class="position-absolute" 
                      style="top: 50%; right: 20px; transform: translateY(-50%); cursor: pointer;" 
                      onclick="togglePasswordVisibility()">
                    <i id="password-icon" class="bi bi-eye"></i>
                </span>
            
                <!-- Menampilkan error untuk password -->
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>            

            <!-- Remember Me -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">
                Sign in
            </button>
            
            <!-- Reset Password -->
            <div class="mt-3 text-left">
                @if (Route::has('password.request'))
                    <a class="btn btn-link forgot-password" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>

            <!-- Tambahkan teks "Don't have an account? Sign up" -->
            <div class="mt-3 text-left">
                <p class="text-muted">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="forgot-password">Sign up</a>
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
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('floatingPassword');
        const passwordIcon = document.getElementById('password-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.classList.remove('bi-eye');
            passwordIcon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordIcon.classList.remove('bi-eye-slash');
            passwordIcon.classList.add('bi-eye');
        }
    }
</script>

</html>
