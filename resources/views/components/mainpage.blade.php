@props(['title' => 'F1 Archívum'])
<!doctype html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} – F1 Archívum</title>
    <link rel="stylesheet" href="{{ asset('css/utazas.css') }}">
    @stack('head')
</head>
<body>
    @include('header')

    <main>
        @if (session('siker') || session('hiba'))
            <div class="container">
                @if (session('siker'))
                    <div class="alert alert-siker">{{ session('siker') }}</div>
                @endif
                @if (session('hiba'))
                    <div class="alert alert-hiba">{{ session('hiba') }}</div>
                @endif
            </div>
        @endif

        {{ $slot }}
    </main>

    @include('footer')
    @stack('scripts')
</body>
</html>
