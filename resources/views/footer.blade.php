@php
    // TODO: a társ nevét és Neptun-kódját írjátok be!
    $keszitok = [
        ['nev' => 'Kovács Kevin', 'neptun' => 'LXK94M'],
        ['nev' => 'TÁRS NEVE', 'neptun' => 'NEPTUN'],
    ];
@endphp
<footer class="site-footer">
    <div class="container footer-grid">
        <div>
            <strong>🏁 F1 Archívum</strong><br>
            Web-programozás II – beadandó feladat (Laravel)
        </div>
        <div class="footer-keszitok">
            Készítők:
            @foreach ($keszitok as $k)
                {{ $k['nev'] }} ({{ $k['neptun'] }}){{ $loop->last ? '' : ' –' }}
            @endforeach
        </div>
    </div>
</footer>
