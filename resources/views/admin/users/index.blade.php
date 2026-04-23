@extends('admin.layout')

@section('content')
<div class="p-8 users-page">

    <h1 class="text-4xl font-bold mb-8 users-title">{{ __('admin.users.title') }}</h1>

    {{-- SEARCH + ROLE FILTER --}}
    <form method="GET" class="flex flex-col md:flex-row gap-4 mb-6 users-filters">

        <div class="relative w-full md:w-1/3 users-filter-search">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="{{ __('admin.users.search_placeholder') }}"
                class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 bg-white shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
            >
        </div>

        <div class="users-filter-role">
            <select
                name="role"
                class="w-48 px-4 py-2 rounded-lg border border-gray-300 bg-white shadow-sm focus:ring-2 focus:ring-blue-500"
            >
                <option value="all" {{ $role == 'all' ? 'selected' : '' }}>{{ __('admin.users.roles.all') }}</option>
                <option value="admin" {{ $role == 'admin' ? 'selected' : '' }}>{{ __('admin.users.roles.admin') }}</option>
                <option value="user" {{ $role == 'user' ? 'selected' : '' }}>{{ __('admin.users.roles.user') }}</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow users-filter-btn">
            {{ __('admin.users.search_button') }}
        </button>
    </form>

    {{-- DESKTOP TABLE --}}
    <div class="bg-white shadow rounded-xl overflow-hidden users-table-desktop">
        <table class="w-full text-left users-table">
            <thead>
                <tr class="bg-gray-50 border-b text-gray-600 text-sm">
                    <th class="py-3 px-4">ID</th>
                    <th class="py-3 px-4">{{ __('admin.users.table.name') }}</th>
                    <th class="py-3 px-4">{{ __('admin.users.table.email') }}</th>
                    <th class="py-3 px-4">{{ __('admin.users.table.role') }}</th>
                    <th class="py-3 px-4">{{ __('admin.users.table.registered') }}</th>
                    <th class="py-3 px-4">{{ __('admin.users.table.actions') }}</th>
                </tr>
            </thead>

            <tbody class="text-sm">
                @forelse ($users as $user)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="py-3 px-4">{{ $user->id }}</td>
                        <td class="py-3 px-4">{{ $user->name }}</td>
                        <td class="py-3 px-4">{{ $user->email }}</td>
                        <td class="py-3 px-4">
                            @if ($user->role === 'admin')
                                <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                    {{ __('admin.users.roles.admin') }}
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                    {{ __('admin.users.roles.user') }}
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-4">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-3">
                                <a
                                    href="{{ route('admin.users.edit', $user->id) }}"
                                    class="text-blue-600 hover:text-blue-800"
                                    title="{{ __('admin.users.actions.edit_title') }}"
                                >
                                    <i class="fa-solid fa-pen-to-square text-lg"></i>
                                </a>

                                <form
                                    action="{{ route('admin.users.destroy', $user->id) }}"
                                    method="POST"
                                    class="inline js-confirm-delete"
                                    data-confirm="{{ __('admin.users.confirm_delete') }}"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="text-red-600 hover:text-red-800"
                                        title="{{ __('admin.users.actions.delete_title') }}"
                                    >
                                        <i class="fa-solid fa-trash text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-6 text-center text-gray-500">
                            {{ __('admin.users.no_users_found') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- MOBILE CARDS --}}
    <div class="users-mobile-list">
        @forelse ($users as $user)
            <article class="user-mobile-card">
                <div class="user-mobile-top">
                    <div class="user-mobile-main">
                        <h2 class="user-mobile-name">{{ $user->name }}</h2>
                        <div class="user-mobile-email">{{ $user->email }}</div>
                    </div>

                    <div class="user-mobile-id">#{{ $user->id }}</div>
                </div>

                <div class="user-mobile-meta">
                    <div class="user-mobile-row">
                        <span class="label">{{ __('admin.users.table.role') }}</span>
                        <span class="value">
                            @if ($user->role === 'admin')
                                <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                    {{ __('admin.users.roles.admin') }}
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                    {{ __('admin.users.roles.user') }}
                                </span>
                            @endif
                        </span>
                    </div>

                    <div class="user-mobile-row">
                        <span class="label">{{ __('admin.users.table.registered') }}</span>
                        <span class="value">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                </div>

                <div class="user-mobile-actions">
                    <a
                        href="{{ route('admin.users.edit', $user->id) }}"
                        class="mobile-user-action-edit"
                    >
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>{{ __('admin.users.actions.edit_title') }}</span>
                    </a>

                    <form
                        action="{{ route('admin.users.destroy', $user->id) }}"
                        method="POST"
                        class="js-confirm-delete"
                        data-confirm="{{ __('admin.users.confirm_delete') }}"
                    >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="mobile-user-action-delete">
                            <i class="fa-solid fa-trash"></i>
                            <span>{{ __('admin.users.actions.delete_title') }}</span>
                        </button>
                    </form>
                </div>
            </article>
        @empty
            <div class="bg-white shadow rounded-xl px-4 py-6 text-center text-gray-500">
                {{ __('admin.users.no_users_found') }}
            </div>
        @endforelse
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('form.js-confirm-delete').forEach((form) => {
        form.addEventListener('submit', (e) => {
            const msg = form.getAttribute('data-confirm') || 'Are you sure?';
            if (!confirm(msg)) e.preventDefault();
        });
    });
});
</script>
@endpush