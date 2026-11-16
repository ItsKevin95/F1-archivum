<header class="site-header">
    <div class="container nav-bar">
        <a href="{{ route('home') }}" class="brand"><span class="brand-flag">🏁</span> F1 Archívum</a>

        {{-- Hamburger menü mobilon (csak CSS) --}}
        <input type="checkbox" id="nav-toggle" class="nav-toggle" aria-label="Menü megnyitása">
        <label for="nav-toggle" class="nav-burger" aria-hidden="true"><span></span><span></span><span></span></label>

        <nav class="nav-menu">
            <a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Főoldal</a>
            <a href="{{ route('adatbazis') }}" @class(['active' => request()->routeIs('adatbazis')])>Adatbázis</a>
            <a href="{{ route('kapcsolat') }}" @class(['active' => request()->routeIs('kapcsolat')])>Kapcsolat</a>
            <a href="{{ route('diagram') }}" @class(['active' => request()->routeIs('diagram')])>Diagram</a>

            @auth
                <a href="{{ route('uzenetek') }}" @class(['active' => request()->routeIs('uzenetek')])>Üzenetek</a>
                @if (Auth::user()->role == 1)
                    <a href="{{ route('crud.index') }}" @class(['active' => request()->routeIs('crud.*')])>CRUD</a>
                @endif
                <form method="post" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="nav-link-button">Kijelentkezés ({{ Auth::user()->name }})</button>
                </form>
            @else
                <a href="{{ route('login') }}">Bejelentkezés</a>
                <a href="{{ route('register') }}" class="nav-cta">Regisztráció</a>
            @endauth
        </nav>
    </div>
</header>
