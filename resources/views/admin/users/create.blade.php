@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-900">
    <div class="space-y-4">
        @if ($errors->any())
            <div class="alert alert-danger mb-6 bg-red-800 border border-red-600 text-red-300 rounded-md p-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success mb-6 bg-green-800 border border-green-600 text-green-300 rounded-md p-4">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning mb-6 bg-yellow-800 border border-yellow-600 text-yellow-300 rounded-md p-4">
                <p>{{ session('warning') }}</p>
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info mb-6 bg-blue-800 border border-blue-600 text-blue-300 rounded-md p-4">
                <p>{{ session('info') }}</p>
            </div>
        @endif
    </div>

    <div class="max-w-4xl mx-auto bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-100 mb-4">Create New User</h1>
        <form action="{{ route('admin.users.store') }}" method="POST" autocomplete="off">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border border-gray-600 bg-gray-700 text-gray-300 rounded-md" required autocomplete="off">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full border border-gray-600 bg-gray-700 text-gray-300 rounded-md" required autocomplete="off">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full border border-gray-600 bg-gray-700 text-gray-300 rounded-md" required autocomplete="new-password">
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border border-gray-600 bg-gray-700 text-gray-300 rounded-md" required autocomplete="new-password">
            </div>
            <div class="mb-4">
                <label for="role_id" class="block text-sm font-medium text-gray-300">Role</label>
                <select name="role_id" id="role_id" class="mt-1 block w-full border border-gray-600 bg-gray-700 text-gray-300 rounded-md" required autocomplete="off">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">Create User</button>
        </form>
    </div>
</div>
@endsection
