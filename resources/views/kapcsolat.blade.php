<x-mainpage title="Kapcsolat">
    <div class="container section narrow">
        <h1>Kapcsolat</h1>
        <p class="muted">Kérdése van az adatbázissal vagy az oldallal kapcsolatban? Írjon nekünk, és hamarosan válaszolunk.</p>

        <form method="post" action="{{ route('kapcsolat.kuld') }}" class="form" novalidate>
            @csrf

            <div class="field">
                <label for="nev">Név</label>
                <input type="text" id="nev" name="nev" value="{{ old('nev') }}" @class(['invalid' => $errors->has('nev')])>
                @error('nev') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="field">
                <label for="email">E-mail cím</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" @class(['invalid' => $errors->has('email')])>
                @error('email') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="field">
                <label for="targy">Tárgy</label>
                <input type="text" id="targy" name="targy" value="{{ old('targy') }}" @class(['invalid' => $errors->has('targy')])>
                @error('targy') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="field">
                <label for="uzenet">Üzenet</label>
                <textarea id="uzenet" name="uzenet" rows="6" @class(['invalid' => $errors->has('uzenet')])>{{ old('uzenet') }}</textarea>
                @error('uzenet') <small class="error">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Üzenet küldése</button>
        </form>
    </div>
</x-mainpage>
