<x-mainpage title="Adatbázis">
    <div class="container section">
        <h1>Adatbázis</h1>
        <p class="muted">A Forma–1 adatai három táblából (nagydíj, pilóta, eredmény), Eloquent ORM-mel lekérdezve. Az eredmények az 1950–1960 közötti futamokról állnak rendelkezésre.</p>

        <form method="get" action="{{ route('adatbazis') }}" class="filter">
            <label>Nagydíj helyszíne
                <select name="helyszin">
                    <option value="">Összes</option>
                    @foreach ($helyszinek as $h)
                        <option value="{{ $h }}" @selected(request('helyszin') === $h)>{{ $h }}</option>
                    @endforeach
                </select>
            </label>
            <label>Pilóta nemzetisége
                <select name="nemzet">
                    <option value="">Összes</option>
                    @foreach ($nemzetek as $n)
                        <option value="{{ $n }}" @selected(request('nemzet') === $n)>{{ $n }}</option>
                    @endforeach
                </select>
            </label>
            <label>Pilóta neve
                <input type="text" name="keres" value="{{ request('keres') }}" placeholder="pl. Schumacher">
            </label>
            <label>Eredmények éve
                <select name="ev">
                    <option value="">Összes</option>
                    @foreach ($evek as $e)
                        <option value="{{ $e }}" @selected((string) request('ev') === (string) $e)>{{ $e }}</option>
                    @endforeach
                </select>
            </label>
            <button type="submit" class="btn btn-primary">Szűrés</button>
            <a href="{{ route('adatbazis') }}" class="btn btn-light">Törlés</a>
        </form>

        <h2 id="gp">Nagydíjak</h2>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Dátum</th><th>Nagydíj</th><th>Helyszín</th></tr></thead>
                <tbody>
                @forelse ($nagydijak as $gp)
                    <tr>
                        <td class="nowrap">{{ str_replace('-', '.', $gp->datum) }}</td>
                        <td>{{ $gp->nev }}</td>
                        <td>{{ $gp->helyszin }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="empty">Nincs a feltételeknek megfelelő nagydíj.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $nagydijak->fragment('gp')->links('pagination::bootstrap-5') }}

        <h2 id="pilotak">Pilóták</h2>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Azonosító</th><th>Név</th><th>Nem</th><th>Születési dátum</th><th>Nemzetiség</th><th>Eredmények</th></tr></thead>
                <tbody>
                @forelse ($pilotak as $p)
                    <tr>
                        <td>{{ $p->az }}</td>
                        <td>{{ $p->nev }}</td>
                        <td>{{ $p->nem === 'F' ? 'Férfi' : 'Nő' }}</td>
                        <td class="nowrap">{{ $p->szuldat?->format('Y.m.d') ?? '–' }}</td>
                        <td>{{ $p->nemzet }}</td>
                        <td>{{ $p->eredmenyek_count }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="empty">Nincs a feltételeknek megfelelő pilóta.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $pilotak->fragment('pilotak')->links('pagination::bootstrap-5') }}

        <h2 id="eredmenyek">Eredmények</h2>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Dátum</th><th>Nagydíj</th><th>Pilóta</th><th>Helyezés</th><th>Csapat</th><th>Típus</th><th>Motor</th></tr></thead>
                <tbody>
                @forelse ($eredmenyek as $e)
                    <tr>
                        <td class="nowrap">{{ str_replace('-', '.', $e->datum) }}</td>
                        <td>{{ $e->gp->nev }}</td>
                        <td>{{ $e->pilota->nev }}</td>
                        <td>{{ $e->helyezes ? $e->helyezes.'.' : 'kiesett ('.($e->hiba ?? 'n/a').')' }}</td>
                        <td>{{ $e->csapat ?? 'egyéni induló' }}</td>
                        <td>{{ $e->tipus }}</td>
                        <td>{{ $e->motor }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="empty">Nincs a feltételeknek megfelelő eredmény.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $eredmenyek->fragment('eredmenyek')->links('pagination::bootstrap-5') }}
    </div>
</x-mainpage>
