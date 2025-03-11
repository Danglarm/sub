@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Изменение подписки</h1>
        <form action="{{ route('subscriptions.change-plan', $subscription->id) }}" method="POST">
            @csrf
            @method('PUT')


            <div class="mb-4">
                <label for="plan" class="block text-sm font-medium text-gray-700">Название</label>
                <input type="text" id="title" name="title" value="{{ $subscription->title }}" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="plan" class="block text-sm font-medium text-gray-700">Категория</label>
                <input type="text" id="category" name="category" value="{{ $subscription->category }}" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="plan" class="block text-sm font-medium text-gray-700">План</label>
                <select id="plan" name="plan" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="basic" {{ $subscription->plan === 'basic' ? 'selected' : '' }}>Базовый</option>
                    <option value="premium" {{ $subscription->plan === 'premium' ? 'selected' : '' }}>Премиум</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Цена</label>
                <input type="number" id="price" name="price" step="10" value="{{ $subscription->price }}" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Изменить подписку
            </button>
            <div class="mt-4">
            <a href="{{ route('subscriptions.history') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                Назад ко всем подпискам
            </a>
          
      
        <div class="mt-4">
            <a href="{{ route('profile') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                Перейти в профиль
            </a>
        </div>
        </form>
    </div>
</div>
@endsection