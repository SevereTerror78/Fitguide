<!DOCTYPE html>
<<<<<<< HEAD
<<<<<<< HEAD
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FitGuide Admin</title>
=======
=======
>>>>>>> 5c55d34 (new features)
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('admin.layout.title') }}</title>
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}" />
</head>

<<<<<<< HEAD
<<<<<<< HEAD
<body class="bg-gray-100">

    <div class="flex">

        {{-- SIDEBAR --}}
        <aside class="w-64 h-screen bg-gray-900 text-white p-6 space-y-8">

            <div class="text-2xl font-bold">Admin</div>
=======
=======
>>>>>>> 5c55d34 (new features)
@php
    $adminUnreadNotifications = \App\Models\AdminNotification::whereNull('read_at')->count();
@endphp

<body class="bg-gray-100 h-screen overflow-hidden">

    <div class="flex h-full">

        {{-- SIDEBAR --}}
        <aside class="w-64 bg-gray-900 text-white p-6 space-y-8 flex-shrink-0 overflow-y-auto">

            <div class="text-2xl font-bold">{{ __('admin.layout.admin') }}</div>
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)

            <nav class="space-y-3 text-gray-300">

                <a href="{{ route('admin.dashboard') }}"
<<<<<<< HEAD
<<<<<<< HEAD
                class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('admin/dashboard') ? 'bg-gray-700 text-white' : '' }}">
                Dashboard
                </a>

                <a href="{{ route('admin.products.index') }}"
                    class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('admin/products*') ? 'bg-gray-700 text-white' : '' }}">
                    Products
                </a>

                <a href="{{ route('admin.orders.index') }}"
                    class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('admin/orders*') ? 'bg-gray-700 text-white' : '' }}">
                    Orders
                </a>

                <a href="{{ route('admin.users.index') }}"
                    class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('admin/users*') ? 'bg-gray-700 text-white' : '' }}">
                Users
                </a>

                {{-- DIVIDER --}}
                <div class="pt-8 border-t border-gray-700"></div>

                {{-- SETTINGS --}}
                <a href="#"
                class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-700">
                    <i class="fa-solid fa-gear"></i>
                    Settings
                </a>

                {{-- 🔙 BACK TO SITE --}}
                <a href="{{ route('home') }}"
                class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-700 text-blue-300">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back to Site
                </a>
                {{-- LOGOUT --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-700 text-red-400">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
=======
=======
>>>>>>> 5c55d34 (new features)
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
                   class="relative flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('admin/notifications*') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fa-regular fa-bell"></i>
                    <span>{{ __('admin.nav.notifications') }}</span>

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
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
                    </button>
                </form>

            </nav>

        </aside>

<<<<<<< HEAD
<<<<<<< HEAD
        {{-- MAIN --}}
        <main class="flex-1">
=======
        {{-- MAIN CONTENT --}}
        <main class="flex-1 overflow-y-auto">
>>>>>>> fc7673c (frontend update and some new feature)
=======
        {{-- MAIN CONTENT --}}
        <main class="flex-1 overflow-y-auto">
>>>>>>> 5c55d34 (new features)
            @yield('content')
        </main>

    </div>

    @stack('scripts')
</body>
<<<<<<< HEAD
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> fc7673c (frontend update and some new feature)
=======
</html>
>>>>>>> 5c55d34 (new features)
