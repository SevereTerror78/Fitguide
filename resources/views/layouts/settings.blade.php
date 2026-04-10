<!DOCTYPE html>
<<<<<<< HEAD
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php($t = auth()->user()->theme ?? 'dark')
    <link id="theme-css" rel="stylesheet" href="{{ asset('css/themes/'.$t.'.css') }}?v={{ time() }}">
=======
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      data-theme="{{ auth()->user()->theme ?? 'dark' }}">

<head>
    @php($t = auth()->user()->theme ?? 'dark')

>>>>>>> fc7673c (frontend update and some new feature)
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Settings - FitGuide')</title>

<<<<<<< HEAD
=======
    {{-- PRELOAD ALL THEMES (NO RELOAD = NO JUMP) --}}
    <link rel="stylesheet" href="{{ asset('css/themes/light.css') }}" id="theme-light" {{ $t === 'light' ? '' : 'disabled' }}>
    <link rel="stylesheet" href="{{ asset('css/themes/dark.css') }}" id="theme-dark" {{ $t === 'dark' ? '' : 'disabled' }}>
    <link rel="stylesheet" href="{{ asset('css/themes/hc.css') }}" id="theme-colorblind" {{ $t === 'hc' ? '' : 'disabled' }}>

>>>>>>> fc7673c (frontend update and some new feature)
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
</head>

<<<<<<< HEAD
<body data-theme="{{ $t }}">
    <header class="settings-header">
        <h1>Settings</h1>
        <nav>
            <a href="{{ route('dashboard') }}">Back to Dashboard</a>

            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </nav>
    </header>

    <main class="settings-main">
        @yield('content')
    </main>
</body>
<script>
    document.querySelectorAll('.theme-btn').forEach(button => {
        button.addEventListener('click', () => {
            const t = button.dataset.theme;

            // 1️⃣ hidden input frissítése (mentéshez)
            document.getElementById('theme-input').value = t;

            // 2️⃣ active state UI
            document.querySelectorAll('.theme-btn')
                .forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            // 3️⃣ AZONNALI THEME PREVIEW (EZ HIÁNYZOTT)
            document.body.setAttribute('data-theme', t);
        });
    });
</script>

=======
<body class="settings-body" data-theme="{{ $t }}">

<header class="settings-header">
    <h1>Settings</h1>
</header>

<main class="settings-main">
    @yield('content')
</main>

<script>
/* ===============================
   THEME SWITCH – STABLE VERSION
   =============================== */
function setTheme(t){
    document.documentElement.setAttribute('data-theme', t);
    document.body.setAttribute('data-theme', t);

    ['light','dark','colorblind'].forEach(x => {
        const el = document.getElementById(`theme-${x}`);
        if (el) el.disabled = true;
    });

    const active = document.getElementById(`theme-${t}`);
    if (active) active.disabled = false;
}

document.addEventListener('click', e => {
    const btn = e.target.closest('.theme-btn');
    if (!btn) return;

    const t = btn.dataset.theme;

    const input = document.getElementById('theme-input');
    if (input) input.value = t;

    document.querySelectorAll('.theme-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    document.body.classList.add('theme-switching');
    setTheme(t);
    setTimeout(() => document.body.classList.remove('theme-switching'), 120);
});
</script>

</body>
>>>>>>> fc7673c (frontend update and some new feature)
</html>
