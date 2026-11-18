<x-mainpage title="CRUD – Pilóták">
    <div class="container section">
        <div class="page-head">
            <h1>Pilóták kezelése</h1>
            <a href="{{ route('crud.create') }}" class="btn btn-primary">+ Új pilóta</a>
        </div>

        <form method="get" action="{{ route('crud.index') }}" class="filter">
            <label>Név
                <input type="text" name="keres" value="{{ request('keres') }}" placeholder="keresés névre">
            </label>
            <label>Nemzetiség
                <select name="nemzet">
                    <option value="">Összes</option>
                    @foreach ($nemzetek as $n)
                        <option value="{{ $n }}" @selected(request('nemzet') === $n)>{{ $n }}</option>
                    @endforeach
                </select>
            </label>
            <button type="submit" class="btn btn-primary">Szűrés</button>
            <a href="{{ route('crud.index') }}" class="btn btn-light">Törlés</a>
        </form>

        <div class="table-wrap">
            <table>
                <thead><tr><th>#</th><th>Név</th><th>Nem</th><th>Születési dátum</th><th>Nemzetiség</th><th>Eredmények</th><th>Műveletek</th></tr></thead>
                <tbody>
                @forelse ($pilotak as $p)
                    <tr>
                        <td>{{ $p->az }}</td>
                        <td>{{ $p->nev }}</td>
                        <td>{{ $p->nem }}</td>
                        <td class="nowrap">{{ $p->szuldat?->format('Y.m.d') ?? '–' }}</td>
                        <td>{{ $p->nemzet }}</td>
                        <td>{{ $p->eredmenyek_count }}</td>
                        <td class="actions">
                            <a href="{{ route('crud.edit', $p) }}" class="btn btn-small btn-light">Szerkesztés</a>
                            <form method="post" action="{{ route('crud.destroy', $p) }}"
                                  onsubmit="return confirm('Biztosan törli ezt a pilótát? Az eredményei is törlődnek.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-small btn-danger">Törlés</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="empty">Nincs megjeleníthető pilóta.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $pilotak->links('pagination::bootstrap-5') }}
    </div>
</x-mainpage>
