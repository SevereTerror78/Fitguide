<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php($t = auth()->user()->theme ?? 'dark')
    <link id="theme-css" rel="stylesheet" href="{{ asset('css/themes/'.$t.'.css') }}?v={{ time() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Settings - FitGuide')</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
</head>

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

</html>
