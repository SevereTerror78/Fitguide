@extends('admin.layout')

@section('content')
<div class="p-8 max-w-xl mx-auto bg-white shadow rounded-xl">

<<<<<<< HEAD
    <h1 class="text-3xl font-bold mb-8">Edit User</h1>
=======
    <h1 class="text-3xl font-bold mb-8">{{ __('admin.users.edit_title') }}</h1>
>>>>>>> fc7673c (frontend update and some new feature)

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Name --}}
<<<<<<< HEAD
        <label class="block font-semibold mb-1">Name</label>
=======
        <label class="block font-semibold mb-1">{{ __('admin.users.form.name') }}</label>
>>>>>>> fc7673c (frontend update and some new feature)
        <input type="text" name="name" value="{{ $user->name }}"
               class="w-full mb-4 px-4 py-2 border rounded-lg">

        {{-- Email --}}
<<<<<<< HEAD
        <label class="block font-semibold mb-1">Email</label>
        <input type="email" name="email" value="{{ $user->email }}"
               class="w-full mb-4 px-4 py-2 border rounded-lg">

               <select name="role" class="w-full mb-6 px-4 py-2 border rounded-lg">
                @if ($user->id === auth()->id())
                    <option value="admin" selected>Admin</option>
                @else
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                @endif
            </select>

            <button class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 mt-6">
                Save Changes
            </button>
=======
        <label class="block font-semibold mb-1">{{ __('admin.users.form.email') }}</label>
        <input type="email" name="email" value="{{ $user->email }}"
               class="w-full mb-4 px-4 py-2 border rounded-lg">

        {{-- Role --}}
        <label class="block font-semibold mb-1">{{ __('admin.users.form.role') }}</label>
        <select name="role" class="w-full mb-6 px-4 py-2 border rounded-lg">
            @if ($user->id === auth()->id())
                <option value="admin" selected>{{ __('admin.users.roles.admin') }}</option>
            @else
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>{{ __('admin.users.roles.admin') }}</option>
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>{{ __('admin.users.roles.user') }}</option>
            @endif
        </select>

        <button class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 mt-6">
            {{ __('admin.users.save_changes') }}
        </button>
>>>>>>> fc7673c (frontend update and some new feature)

    </form>

</div>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> fc7673c (frontend update and some new feature)
