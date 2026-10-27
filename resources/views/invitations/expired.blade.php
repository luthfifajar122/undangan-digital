<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Undangan Kadaluarsa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="text-center p-8 bg-white rounded-lg shadow max-w-md">
        <div class="text-6xl mb-4">⏰</div>
        <h1 class="text-2xl font-bold mb-2">Undangan Kadaluarsa</h1>
        <p class="text-gray-600 mb-4">
            Undangan untuk {{ $invitation->bride_name }} & {{ $invitation->groom_name }} 
            sudah tidak tersedia lagi.
        </p>
        <p class="text-sm text-gray-500">
            Hubungi admin untuk informasi lebih lanjut.
        </p>
        @php($wa = preg_replace('/\D+/', '', (string) env('WHATSAPP_NUMBER', '')))
        @if ($wa)
            <a href="https://wa.me/{{ $wa }}" target="_blank" class="inline-block mt-4 bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                Hubungi Admin
            </a>
        @endif
    </div>
</body>
</html>