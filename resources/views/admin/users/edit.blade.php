@extends('admin.layout')

@section('content')
<div class="p-4 md:p-8">
    <div class="max-w-xl mx-auto bg-white shadow rounded-xl p-5 md:p-8">
        <h1 class="text-2xl md:text-3xl font-bold mb-8">{{ __('admin.users.edit_title') }}</h1>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label class="block font-semibold mb-1">{{ __('admin.users.form.name') }}</label>
            <input type="text" name="name" value="{{ $user->name }}"
                   class="w-full mb-4 px-4 py-3 border rounded-lg">

            <label class="block font-semibold mb-1">{{ __('admin.users.form.email') }}</label>
            <input type="email" name="email" value="{{ $user->email }}"
                   class="w-full mb-4 px-4 py-3 border rounded-lg">

            <label class="block font-semibold mb-1">{{ __('admin.users.form.role') }}</label>
            <select name="role" class="w-full mb-6 px-4 py-3 border rounded-lg">
                @if ($user->id === auth()->id())
                    <option value="admin" selected>{{ __('admin.users.roles.admin') }}</option>
                @else
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>{{ __('admin.users.roles.admin') }}</option>
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>{{ __('admin.users.roles.user') }}</option>
                @endif
            </select>

            <button class="w-full md:w-auto px-5 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 mt-2">
                {{ __('admin.users.save_changes') }}
            </button>
        </form>
    </div>
</div>
@endsection