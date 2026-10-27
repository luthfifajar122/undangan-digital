<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .admin-shell { min-height:100vh; background:#f7f6f3; }
        .admin-sidebar { width:258px; min-height:100vh; background:#29241f; }
        .admin-content { min-width:0; margin-left:258px; padding:2rem clamp(1rem,3vw,2.75rem); }
        .admin-nav-link { display:flex; align-items:center; gap:.75rem; padding:.75rem .85rem; border-radius:.75rem; color:#c8c0b7; font-size:.925rem; font-weight:500; transition:background .18s,color .18s; }
        .admin-nav-link:hover { color:white; background:#39332d; }
        .admin-nav-link.is-active { color:white; background:#554438; box-shadow:inset 3px 0 #d4a574; }
        .admin-card { border:1px solid #ece8e2; border-radius:1rem; background:white; box-shadow:0 8px 24px rgb(41 36 31 / .045); }
        .admin-table { min-width:720px; border-collapse:collapse; }
        .admin-table thead { background:#faf9f7; color:#82786d; font-size:.72rem; letter-spacing:.07em; text-transform:uppercase; }
        .admin-table th { font-weight:600; }
        .admin-table tbody tr { border-top:1px solid #f0ede8; transition:background .15s; }
        .admin-table tbody tr:hover { background:#fcfbf9; }
        .admin-table td:last-child { white-space:nowrap; }
        .admin-table td:last-child a, .admin-table td:last-child button { display:inline-flex; min-height:2rem; align-items:center; justify-content:center; margin-right:.25rem; padding:.35rem .65rem; border:1px solid #e8e2da; border-radius:.55rem; background:#fff; color:#554438; font-size:.75rem; font-weight:600; line-height:1; text-decoration:none; transition:background .15s,border-color .15s,color .15s; }
        .admin-table td:last-child a:hover { border-color:#d9c4ae; background:#f8f3ed; color:#4a3528; }
        .admin-table td:last-child form { display:inline; }
        .admin-table td:last-child button { border-color:#f1d6d3; color:#b42318; cursor:pointer; }
        .admin-table td:last-child button:hover { border-color:#e9b9b4; background:#fff5f4; color:#912018; }
        .admin-content input:not([type=checkbox]):not([type=file]), .admin-content select, .admin-content textarea { border-color:#e7e2db; border-radius:.65rem; background:#fff; transition:border-color .15s,box-shadow .15s; }
        .admin-content input:focus, .admin-content select:focus, .admin-content textarea:focus { outline:0; border-color:#b58b65; box-shadow:0 0 0 3px rgb(212 165 116 / .18); }
        .admin-content label { color:#49423a; font-size:.875rem; }
        .admin-content button[type=submit], .admin-primary { border-radius:.65rem; background:#6b4e3d; font-weight:600; transition:background .15s,transform .15s; }
        .admin-content button[type=submit]:hover, .admin-primary:hover { background:#4a3528; }
        .admin-content button[type=submit]:active, .admin-primary:active { transform:translateY(1px); }
        @media (max-width:768px) {
            .admin-sidebar { width:100%; min-height:auto; position:relative; }
            .admin-content { margin-left:0; padding:1.25rem 1rem 2rem; }
            .admin-nav { display:flex; overflow-x:auto; padding:.5rem .75rem 1rem !important; gap:.35rem !important; }
            .admin-nav-link { flex:0 0 auto; padding:.65rem .8rem; }
            .admin-nav-link.is-active { box-shadow:inset 0 -2px #d4a574; }
            .admin-sidebar > div.absolute { display:none; }
        }
    </style>
</head>
<body class="text-gray-900">
    <div class="admin-shell">
        <aside class="admin-sidebar fixed left-0 top-0 z-40 text-white">
            <div class="px-6 py-6 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <span class="grid h-10 w-10 place-items-center rounded-xl bg-[#d4a574] text-lg font-bold text-[#29241f]">U</span>
                    <div><h1 class="text-lg font-semibold tracking-tight">Undangan</h1><p class="text-xs text-gray-400">Ruang Admin</p></div>
                </div>
            </div>
            <nav class="admin-nav p-4 space-y-2">
                <a href="{{ route('admin.invitations.index') }}" class="admin-nav-link {{ request()->routeIs('admin.invitations.*') ? 'is-active' : '' }}"><span aria-hidden="true">✉</span> Undangan</a>
                <a href="{{ route('admin.templates.index') }}" class="admin-nav-link {{ request()->routeIs('admin.templates.*') ? 'is-active' : '' }}"><span aria-hidden="true">✦</span> Template</a>
                <a href="{{ route('admin.rsvps.index') }}" class="admin-nav-link {{ request()->routeIs('admin.rsvps.*') ? 'is-active' : '' }}"><span aria-hidden="true">✓</span> RSVP</a>
            </nav>
            <div class="absolute bottom-0 w-full border-t border-white/10 p-5 text-xs text-gray-500">Undangan Digital <span class="float-right">Admin</span></div>
        </aside>
        <main class="admin-content">
            <div class="mx-auto max-w-screen-2xl">
                @if (session('success'))
                    <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">{{ session('error') }}</div>
                @endif
                @if (session('import_errors'))
                    <div class="mb-5 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900">
                        <p class="mb-1 font-semibold">Error Import</p>
                        <ul class="ml-4 list-disc">@foreach (session('import_errors') as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
