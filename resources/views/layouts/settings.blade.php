<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      data-theme="{{ auth()->user()->theme ?? 'dark' }}">

<head>
    @php($t = auth()->user()->theme ?? 'dark')

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Settings - FitGuide')</title>

    {{-- PRELOAD ALL THEMES (NO RELOAD = NO JUMP) --}}
    <link rel="stylesheet" href="{{ asset('css/themes/light.css') }}" id="theme-light" {{ $t === 'light' ? '' : 'disabled' }}>
    <link rel="stylesheet" href="{{ asset('css/themes/dark.css') }}" id="theme-dark" {{ $t === 'dark' ? '' : 'disabled' }}>
    <link rel="stylesheet" href="{{ asset('css/themes/colorblind.css') }}" id="theme-colorblind" {{ $t === 'colorblind' ? '' : 'disabled' }}>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
</head>

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
</html>
