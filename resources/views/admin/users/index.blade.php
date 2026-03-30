@extends('admin.layout')

@section('content')
<div class="p-8">

    {{-- PAGE TITLE --}}
<<<<<<< HEAD
<<<<<<< HEAD
    <h1 class="text-4xl font-bold mb-8">Users</h1>
=======
    <h1 class="text-4xl font-bold mb-8">{{ __('admin.users.title') }}</h1>
>>>>>>> fc7673c (frontend update and some new feature)
=======
    <h1 class="text-4xl font-bold mb-8">{{ __('admin.users.title') }}</h1>
>>>>>>> 5c55d34 (new features)

    {{-- SEARCH + ROLE FILTER --}}
    <form method="GET" class="flex flex-col md:flex-row gap-4 mb-6">

        {{-- Search Input --}}
        <div class="relative w-full md:w-1/3">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" name="search" value="{{ $search }}"
<<<<<<< HEAD
<<<<<<< HEAD
                   placeholder="Search users..."
=======
                   placeholder="{{ __('admin.users.search_placeholder') }}"
>>>>>>> fc7673c (frontend update and some new feature)
=======
                   placeholder="{{ __('admin.users.search_placeholder') }}"
>>>>>>> 5c55d34 (new features)
                   class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 bg-white shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        {{-- Role Select --}}
        <div>
<<<<<<< HEAD
<<<<<<< HEAD
        <select name="role"
            class="w-48 px-4 py-2 rounded-lg border border-gray-300 bg-white shadow-sm focus:ring-2 focus:ring-blue-500">
                <option value="all" {{ $role=='all' ? 'selected' : '' }}>All Roles</option>
                <option value="admin" {{ $role=='admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $role=='user' ? 'selected' : '' }}>User</option>
=======
=======
>>>>>>> 5c55d34 (new features)
            <select name="role"
                class="w-48 px-4 py-2 rounded-lg border border-gray-300 bg-white shadow-sm focus:ring-2 focus:ring-blue-500">
                <option value="all" {{ $role=='all' ? 'selected' : '' }}>{{ __('admin.users.roles.all') }}</option>
                <option value="admin" {{ $role=='admin' ? 'selected' : '' }}>{{ __('admin.users.roles.admin') }}</option>
                <option value="user" {{ $role=='user' ? 'selected' : '' }}>{{ __('admin.users.roles.user') }}</option>
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
            </select>
        </div>

        {{-- Search Button --}}
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
<<<<<<< HEAD
<<<<<<< HEAD
            Search
=======
            {{ __('admin.users.search_button') }}
>>>>>>> fc7673c (frontend update and some new feature)
=======
            {{ __('admin.users.search_button') }}
>>>>>>> 5c55d34 (new features)
        </button>

    </form>

<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
    {{-- USERS TABLE --}}
    <div class="bg-white shadow rounded-xl overflow-hidden">

        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 border-b text-gray-600 text-sm">
                    <th class="py-3 px-4">ID</th>
<<<<<<< HEAD
<<<<<<< HEAD
                    <th class="py-3 px-4">Name</th>
                    <th class="py-3 px-4">Email</th>
                    <th class="py-3 px-7">Role</th>
                    <th class="py-3 px-4">Registered</th>
                    <th class="py-3 px-4">Actions</th>
=======
=======
>>>>>>> 5c55d34 (new features)
                    <th class="py-3 px-4">{{ __('admin.users.table.name') }}</th>
                    <th class="py-3 px-4">{{ __('admin.users.table.email') }}</th>
                    <th class="py-3 px-7">{{ __('admin.users.table.role') }}</th>
                    <th class="py-3 px-4">{{ __('admin.users.table.registered') }}</th>
                    <th class="py-3 px-4">{{ __('admin.users.table.actions') }}</th>
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
                </tr>
            </thead>

            <tbody class="text-sm">
                @forelse ($users as $user)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="py-3 px-4">{{ $user->id }}</td>
                    <td class="py-3 px-4">{{ $user->name }}</td>
                    <td class="py-3 px-4">{{ $user->email }}</td>
<<<<<<< HEAD
<<<<<<< HEAD
                    <td class="py-3 px-4">
                        @if ($user->role === 'admin')
                            <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">Admin</span>
                        @else
                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">User</span>
                        @endif
                    </td>
                    <td class="py-3 px-4">{{ $user->created_at->format('M d, Y') }}</td>

                   <td class="py-3 px-4 flex items-center gap-3">

                        {{-- EDIT --}}
                        <a href="{{ route('admin.users.edit', $user->id) }}"
                        class="text-blue-600 hover:text-blue-800"
                        title="Edit User">
=======
=======
>>>>>>> 5c55d34 (new features)

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

                    <td class="py-3 px-4 flex items-center gap-3">

                        {{-- EDIT --}}
                        <a href="{{ route('admin.users.edit', $user->id) }}"
                           class="text-blue-600 hover:text-blue-800"
                           title="{{ __('admin.users.actions.edit_title') }}">
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
                            <i class="fa-solid fa-pen-to-square text-lg"></i>
                        </a>

                        {{-- DELETE --}}
<<<<<<< HEAD
<<<<<<< HEAD
                        <form action="{{ route('admin.users.destroy', $user->id) }}" 
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this user?')"
                            class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:text-red-800"
                                    title="Delete User">
=======
=======
>>>>>>> 5c55d34 (new features)
                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                            method="POST"
                            class="inline js-confirm-delete"
                            data-confirm="{{ __('admin.users.confirm_delete') }}">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:text-red-800"
                                    title="{{ __('admin.users.actions.delete_title') }}">
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
                                <i class="fa-solid fa-trash text-lg"></i>
                            </button>
                        </form>

                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-6 text-center text-gray-500">
<<<<<<< HEAD
<<<<<<< HEAD
                        No users found.
=======
                        {{ __('admin.users.no_users_found') }}
>>>>>>> fc7673c (frontend update and some new feature)
=======
                        {{ __('admin.users.no_users_found') }}
>>>>>>> 5c55d34 (new features)
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
<<<<<<< HEAD
<<<<<<< HEAD

    </div>
</div>
@endsection
=======
=======
>>>>>>> 5c55d34 (new features)
    </div>
</div>
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
<<<<<<< HEAD
@endsection
>>>>>>> fc7673c (frontend update and some new feature)
=======
@endsection
>>>>>>> 5c55d34 (new features)
