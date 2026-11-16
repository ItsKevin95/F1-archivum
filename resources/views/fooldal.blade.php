<x-mainpage title="Főoldal">
    <section class="hero">
        <div class="container hero-inner">
            <p class="hero-kicker">{{ $statisztika['tol'] }}–{{ $statisztika['ig'] }} · {{ number_format($statisztika['nagydijak'], 0, ',', ' ') }} nagydíj</p>
            <h1>A Forma–1 <span>története</span> egy helyen</h1>
            <p class="hero-text">
                Az összes nagydíj {{ $statisztika['tol'] }}-től {{ $statisztika['ig'] }}-ig, a pilóták adatai és az első évtized (1950–1960) részletes eredményei.
                Böngéssz az adatbázisban, fedezd fel a legsikeresebb versenyzőket, és nézd meg diagramokon is.
            </p>
            <div class="hero-buttons">
                <a href="{{ route('adatbazis') }}" class="btn btn-primary">Adatbázis böngészése</a>
                <a href="{{ route('diagram') }}" class="btn btn-light">Diagramok</a>
            </div>
        </div>
        <div class="hero-flag" aria-hidden="true"></div>
    </section>

    <section class="container stats">
        <div class="stat"><strong>{{ number_format($statisztika['nagydijak'], 0, ',', ' ') }}</strong><span>nagydíj</span></div>
        <div class="stat"><strong>{{ number_format($statisztika['pilotak'], 0, ',', ' ') }}</strong><span>pilóta</span></div>
        <div class="stat"><strong>{{ number_format($statisztika['eredmenyek'], 0, ',', ' ') }}</strong><span>eredmény</span></div>
        <div class="stat"><strong>{{ $statisztika['ig'] - $statisztika['tol'] + 1 }}</strong><span>szezon</span></div>
    </section>

    <section class="container section">
        <h2>Legsikeresebb pilóták</h2>
        <p class="muted">A legtöbb futamgyőzelmet szerző versenyzők az 1950–1960 közötti eredmények alapján.</p>
        <div class="card-grid card-grid-5">
            @foreach ($legjobbak as $p)
                <article class="driver">
                    <span class="driver-rank">{{ $loop->iteration }}</span>
                    <h3>{{ $p->nev }}</h3>
                    <p class="muted">{{ $p->nemzet }}</p>
                    <p class="driver-wins"><strong>{{ $p->gyozelmek }}</strong> győzelem</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="container section">
        <h2>Legutóbbi rögzített futamok</h2>
        <div class="card-grid card-grid-4">
            @foreach ($legutobbiak as $gp)
                @php $gyoztes = $gp->eredmenyek->first(); @endphp
                <article class="gpcard">
                    <p class="gpcard-date">{{ str_replace('-', '.', $gp->datum) }}</p>
                    <h3>{{ $gp->nev }} Nagydíj</h3>
                    <p class="muted">{{ $gp->helyszin }}</p>
                    @if ($gyoztes)
                        <p class="gpcard-winner">🏆 {{ $gyoztes->pilota->nev }}<br><small>{{ $gyoztes->csapat ?? 'egyéni induló' }}</small></p>
                    @endif
                </article>
            @endforeach
        </div>
    </section>
</x-mainpage>
