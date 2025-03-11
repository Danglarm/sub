
@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Createыыыыыы Subscription</h1>
        <form action="{{ route('subscriptions.create') }}" method="POST">
            @csrf
            <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Subscription Title</label>
            <input type="text" name="title" id="title" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        </div>
            <div class="mb-4">
                <label for="plan" class="block text-sm font-medium text-gray-700">Plan</label>
                <select id="plan" name="plan" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="basic">Basic</option>
                    <option value="premium">Premium</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" id="price" name="price" step="0.01" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Create Subscription
            </button>
        </form>
        <!-- Кнопка "Назад" -->
    <div class="mt-4">
        <a href="{{ route('profile') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
            Back to Profile
        </a>
    </div>
    </div>
</div>
@endsection