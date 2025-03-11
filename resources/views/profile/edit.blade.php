@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">Edit Profile</h2>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
            Update Profile
        </button>
    </form>

    <!-- Кнопка "Назад" -->
    <div class="mt-4">
        <a href="{{ route('profile') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
            Back to Profile
        </a>
    </div>
</div>
@endsection