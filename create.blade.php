<x-mainpage title="Új pilóta">
    <div class="container section narrow">
        <h1>Új pilóta</h1>
        <form method="post" action="{{ route('crud.store') }}" class="form" novalidate>
            @csrf
            @include('crud._form')
            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Mentés</button>
                <a href="{{ route('crud.index') }}" class="btn btn-light">Mégse</a>
            </div>
        </form>
    </div>
</x-mainpage>
