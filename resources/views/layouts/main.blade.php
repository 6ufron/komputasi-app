<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
    <!-- Color Mode Script -->
    <script src="{{ asset('template/js/color-mode.js') }}"></script>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, dan kontributor Bootstrap" />
    <meta name="generator" content="Hugo 0.122.0" />
    <link rel="icon" href="{{ asset('images/covers/logo.png') }}" type="image/png" />
    <title>Komputasi-app</title>

    <!-- Importing stylesheets -->
    @include('layouts.styles')

    <!-- Custom styles for specific pages -->
    @yield('this-page-style')
</head>

<body>
    <!-- Theme Toggle Button -->
    @include('layouts.theme')

    <!-- Header -->
    @include('layouts.header')

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Dynamic content based on the current page -->
            @yield('content')
        </div>
    </div>

    <!-- Importing scripts -->
    @include('layouts.scripts')

    <!-- Custom scripts for specific pages -->
    @yield('this-page-scripts')
</body>

</html>
