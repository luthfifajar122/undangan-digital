<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $invitation->bride_name }} & {{ $invitation->groom_name }} - Undangan Pernikahan</title>
    
    <!-- SEO Meta -->
    <meta name="description" content="Kami mengundang Anda merayakan hari bahagia kami. {{ $invitation->bride_name }} & {{ $invitation->groom_name }}">
    <meta property="og:title" content="{{ $invitation->bride_name }} & {{ $invitation->groom_name }} - Undangan Pernikahan">
    <meta property="og:description" content="Kami mengundang Anda merayakan hari bahagia kami.">
    <meta property="og:image" content="{{ $invitation->background_image ? asset('storage/' . $invitation->background_image) : '' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Event",
        "name": "Pernikahan {{ $invitation->bride_name }} & {{ $invitation->groom_name }}",
        "startDate": "{{ $invitation->event_date->format('Y-m-d') }}T{{ $invitation->event_time->format('H:i') }}",
        "location": {
            "@@type": "Place",
            "name": "{{ $invitation->venue_name }}",
            "address": "{{ $invitation->address }}"
        }
    }
    </script>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        :root {
            --color-primary: {{ $config['colors']['primary'] ?? '#8B6947' }};
            --color-secondary: {{ $config['colors']['secondary'] ?? '#D8C3A8' }};
            --color-background: {{ $config['colors']['background'] ?? '#FEFEFA' }};
            --color-text: {{ $config['colors']['text'] ?? '#3D2E1F' }};
            --font-heading: {{ $config['fonts']['heading'] ?? 'Georgia, serif' }};
            --font-body: {{ $config['fonts']['body'] ?? "'Instrument Sans', sans-serif" }};
        }
        body { font-family: var(--font-body); background: var(--color-background); color: var(--color-text); }
        h1, h2, h3, .font-heading { font-family: var(--font-heading); }
    </style>

    @stack('styles')
</head>
<body class="min-h-screen">
    @yield('content')

    <!-- Music Player (global) -->
    @if ($invitation->music_path)
        @include('templates.components.music-player', ['src' => asset('storage/' . $invitation->music_path), 'volume' => $config['defaults']['music_volume'] ?? 0.3])
    @endif

    @stack('scripts')
</body>
</html>