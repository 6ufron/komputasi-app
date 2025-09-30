@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <!-- Header -->
    {{-- <h3 class="fw-bold text-dark">{{ __('Welcome') }}</h3> --}}

    <!-- Pesan Error -->
    @if (session('error'))
        <p class="text-danger mb-4">
            {{ session('error') }}
        </p>
    @endif

    <!-- Logo -->
    <img class="mb-4"
    src="{{ asset('images/covers/logo.png') }}" alt="Logo"
    style="width: 70px; height: 70px;">

    <!-- Pesan Selamat Datang -->
    <h5 class="text-secondary">{{ __('You are logged in!') }}</h5>
    <p class="text-muted mb-4">Explore all features and manage your dashboard easily.</p>

    <!-- Tombol ke Dashboard -->
    <p>
        <a href="/" class="btn btn-primary py-2 px-4">
            <i class="bi bi-house-door me-2"></i>{{ __('Go to Dashboard') }}
        </a>
    </p>

    <!-- Tombol Logout -->
    <form method="POST" action="{{ route('logout') }}" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-danger py-2 px-4">
            <i class="bi bi-box-arrow-right me-2"></i>{{ __('Logout') }}
        </button>
    </form>

    <!-- Footer -->
    <p class="mt-5 text-muted">
        &copy; {{ date('Y') }} KELAS KOMPUTASI_J
    </p>
</div>
@endsection

@section('this-page-style')
<style>
    h3, h5 {
        font-weight: 600;
    }
    .btn-primary, .btn-danger {
        font-size: 1rem;
        font-weight: 600;
        border-radius: 5px;
    }
</style>
@endsection
