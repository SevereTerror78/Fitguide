<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('admin.layout.title') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

@php
    $adminUnreadNotifications = \App\Models\AdminNotification::whereNull('read_at')->count();
@endphp

<body class="bg-gray-100 h-screen">

<div class="flex h-full admin-layout">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-gray-900 text-white p-6 space-y-8 flex-shrink-0 overflow-y-auto admin-sidebar">

        <div class="text-2xl font-bold">{{ __('admin.layout.admin') }}</div>

        <nav class="space-y-3 text-gray-300">

            <a href="{{ route('admin.dashboard') }}"
               class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('admin/dashboard') ? 'bg-gray-700 text-white' : '' }}">
                {{ __('admin.nav.dashboard') }}
            </a>

            <a href="{{ route('admin.products.index') }}"
               class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('admin/products*') ? 'bg-gray-700 text-white' : '' }}">
                {{ __('admin.nav.products') }}
            </a>

            <a href="{{ route('admin.orders.index') }}"
               class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('admin/orders*') ? 'bg-gray-700 text-white' : '' }}">
                {{ __('admin.nav.orders') }}
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('admin/users*') ? 'bg-gray-700 text-white' : '' }}">
                {{ __('admin.nav.users') }}
            </a>

            <div class="pt-8 border-t border-gray-700"></div>

            <a href="{{ route('admin.notifications.index') }}"
               class="relative flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-700">
                <i class="fa-regular fa-bell"></i>
                {{ __('admin.nav.notifications') }}

                @if($adminUnreadNotifications > 0)
                    <span class="absolute right-2 top-2 min-w-[18px] h-[18px] text-xs flex items-center justify-center rounded-full bg-red-500 text-white font-semibold">
                        {{ $adminUnreadNotifications > 99 ? '99+' : $adminUnreadNotifications }}
                    </span>
                @endif
            </a>

            <a href="{{ route('settings.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-700">
                <i class="fa-solid fa-gear"></i>
                {{ __('admin.nav.settings') }}
            </a>

            <a href="{{ route('home') }}"
               class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-700 text-blue-300">
                <i class="fa-solid fa-arrow-left"></i>
                {{ __('admin.nav.back_to_site') }}
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-700 text-red-400">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    {{ __('admin.nav.logout') }}
                </button>
            </form>

        </nav>
    </aside>

    {{-- OVERLAY --}}
    <div id="overlay" class="sidebar-overlay" onclick="toggleSidebar()"></div>

    {{-- MAIN --}}
    <main class="flex-1 overflow-y-auto admin-main">

        {{-- MOBILE HEADER --}}
        <div class="mobile-header md:hidden">
            <button onclick="toggleSidebar()">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
            <span class="font-semibold">{{ __('admin.layout.admin') }}</span>
        </div>

        @yield('content')
    </main>

</div>

<script>
function toggleSidebar() {
    const sidebar = document.querySelector('.admin-sidebar');
    const overlay = document.getElementById('overlay');

    sidebar.classList.toggle('open');
    overlay.classList.toggle('show');
}
</script>

@stack('scripts')
</body>
</html>