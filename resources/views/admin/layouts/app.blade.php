<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .admin-sidebar { width: 250px; min-height: 100vh; }
        .admin-content { margin-left: 250px; }
        @media (max-width: 768px) {
            .admin-sidebar { width: 100%; position: relative; }
            .admin-content { margin-left: 0; }
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="admin-sidebar bg-gray-800 text-white fixed left-0 top-0 z-40">
            <div class="p-4 border-b border-gray-700">
                <h1 class="text-xl font-bold">Admin Panel</h1>
                <p class="text-xs text-gray-400">Undangan Digital</p>
            </div>
            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.invitations.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.invitations.*') ? 'bg-gray-700' : '' }}">
                    📋 Undangan
                </a>
                <a href="{{ route('admin.templates.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.templates.*') ? 'bg-gray-700' : '' }}">
                    🎨 Template
                </a>
                <a href="{{ route('admin.rsvps.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.rsvps.*') ? 'bg-gray-700' : '' }}">
                    ✅ RSVP
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="admin-content flex-1 p-6">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('import_errors'))
                <div class="mb-4 p-4 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded">
                    <p class="font-bold">Error Import:</p>
                    <ul class="list-disc ml-4">
                        @foreach (session('import_errors') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>