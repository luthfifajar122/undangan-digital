<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ruang Undang — Undangan Digital Modern</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            @tailwind base;
            @tailwind components;
            @tailwind utilities;
        </style>
    @endif
</head>
<body class="bg-[var(--color-background)] text-[var(--color-text)]">

@include('layouts.nav')

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @yield('content')
</main>

@include('layouts.footer')

</body>
</html>