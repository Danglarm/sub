@extends('layouts.app')
@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Аналитика по подпискам</h1>

 <!-- Фильтры -->
<div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <h2 class="text-xl font-semibold mb-4">Фильтры</h2>
    <form action="{{ route('profile.analytics') }}" method="GET" class="flex gap-4">
        <div>
            <label for="category" class="block text-sm font-medium text-gray-700">Категории</label>
            <select name="category" id="category" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                <option value="">Все категории</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ $selectedCategory === $category ? 'selected' : '' }}>
                        {{ ucfirst($category) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="period" class="block text-sm font-medium text-gray-700">Период</label>
            <select name="period" id="period" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                <option value="week" {{ $selectedPeriod === 'week' ? 'selected' : '' }}>Последняя Неделя</option>
                <option value="2weeks" {{ $selectedPeriod === '2weeks' ? 'selected' : '' }}>Последние 2 недели</option>
                <option value="month" {{ $selectedPeriod === 'month' ? 'selected' : '' }}>В этом месяце</option>
                <option value="year" {{ $selectedPeriod === 'year' ? 'selected' : '' }}>В этом году</option>
            </select>
        </div>
        <div class="self-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Применить Фильтры
            </button>
        </div>
    </form>
</div>

    <!-- График расходов -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-semibold mb-4">График расходов</h2>
        <canvas id="expensesChart"></canvas>
    </div>

    <!-- Таблица расходов -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Таблица Расходов</h2>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">Заголовок</th>
                    <th class="py-2">Категория</th>
                    <th class="py-2">План</th>
                    <th class="py-2">Цена</th>
                    <th class="py-2">Дата начала</th>
                    <th class="py-2">Дата окончания</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subscriptions as $subscription)
                <tr class="border-t">
                    <td class="py-2">{{ $subscription->title }}</td>
                    <td class="py-2">{{ ucfirst($subscription->category) }}</td>
                    <td class="py-2">{{ ucfirst($subscription->plan) }}</td>
                    <td class="py-2">${{ number_format($subscription->price, 2) }}</td>
                    <td class="py-2">{{ $subscription->start_date->format('Y-m-d') }}</td>
                    <td class="py-2">{{ $subscription->end_date->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4 font-semibold">
            Итоговая сумма: ${{ number_format($totalExpenses, 2) }}
        </div>
    </div>
</div>

<!-- Подключение Chart.js для графиков -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('expensesChart').getContext('2d');
    const expensesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($expensesByCategory-> keys()),
            datasets: [{
                label: 'По категориям',
                data: @json($expensesByCategory-> values()),
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection