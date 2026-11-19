<x-mainpage title="Üzenetek">
    <div class="container section">
        <h1>Üzenetek</h1>
        <p class="muted">A kapcsolat űrlapon keresztül érkezett üzenetek, a legfrissebb elöl.</p>

        <div class="table-wrap">
            <table>
                <thead><tr><th>Küldés ideje</th><th>Név</th><th>E-mail</th><th>Tárgy</th><th>Üzenet</th></tr></thead>
                <tbody>
                @forelse ($uzenetek as $u)
                    <tr>
                        <td class="nowrap">{{ $u->created_at->format('Y.m.d H:i') }}</td>
                        <td>{{ $u->nev }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->targy }}</td>
                        <td>{{ $u->uzenet }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty">Még nem érkezett üzenet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $uzenetek->links('pagination::bootstrap-5') }}
    </div>
</x-mainpage>
