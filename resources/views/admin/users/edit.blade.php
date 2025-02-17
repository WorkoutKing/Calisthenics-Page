@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-100 mb-4">Edit User</h1>
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" class="mt-1 block w-full border border-gray-600 bg-gray-700 text-gray-300 rounded-md" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" class="mt-1 block w-full border border-gray-600 bg-gray-700 text-gray-300 rounded-md" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-300">Password <span class="text-gray-500">(Optional)</span></label>
                <input type="password" name="password" id="password" class="mt-1 block w-full border border-gray-600 bg-gray-700 text-gray-300 rounded-md" autocomplete="new-password">
                <p class="text-sm text-gray-500">Leave blank if you don't want to change the password.</p>
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border border-gray-600 bg-gray-700 text-gray-300 rounded-md" autocomplete="new-password">
            </div>
            <div class="mb-4">
                <label for="role_id" class="block text-sm font-medium text-gray-300">Role</label>
                <select name="role_id" id="role_id" class="mt-1 block w-full border border-gray-600 bg-gray-700 text-gray-300 rounded-md">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                            {{ $role->role_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">Update</button>
        </form>
    </div>
</div>
@endsection
