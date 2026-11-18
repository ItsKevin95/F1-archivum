<x-mainpage title="Pilóta szerkesztése">
    <div class="container section narrow">
        <h1>Pilóta szerkesztése (#{{ $pilota->az }})</h1>
        <form method="post" action="{{ route('crud.update', $pilota) }}" class="form" novalidate>
            @csrf
            @method('PUT')
            @include('crud._form')
            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Módosítás mentése</button>
                <a href="{{ route('crud.index') }}" class="btn btn-light">Mégse</a>
            </div>
        </form>
    </div>
</x-mainpage>
