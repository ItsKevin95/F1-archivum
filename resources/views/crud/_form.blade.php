@php $p = $pilota ?? null; @endphp
<div class="field">
    <label for="nev">Név</label>
    <input type="text" id="nev" name="nev" value="{{ old('nev', $p->nev ?? '') }}" @class(['invalid' => $errors->has('nev')])>
    @error('nev') <small class="error">{{ $message }}</small> @enderror
</div>

<div class="field">
    <label for="nem">Nem</label>
    <select id="nem" name="nem" @class(['invalid' => $errors->has('nem')])>
        <option value="">– válasszon –</option>
        <option value="F" @selected(old('nem', $p->nem ?? '') === 'F')>Férfi (F)</option>
        <option value="N" @selected(old('nem', $p->nem ?? '') === 'N')>Nő (N)</option>
    </select>
    @error('nem') <small class="error">{{ $message }}</small> @enderror
</div>

<div class="field">
    <label for="szuldat">Születési dátum</label>
    <input type="date" id="szuldat" name="szuldat"
           value="{{ old('szuldat', $p?->szuldat?->format('Y-m-d') ?? '') }}" @class(['invalid' => $errors->has('szuldat')])>
    @error('szuldat') <small class="error">{{ $message }}</small> @enderror
</div>

<div class="field">
    <label for="nemzet">Nemzetiség</label>
    <input type="text" id="nemzet" name="nemzet" value="{{ old('nemzet', $p->nemzet ?? '') }}" @class(['invalid' => $errors->has('nemzet')])>
    @error('nemzet') <small class="error">{{ $message }}</small> @enderror
</div>
