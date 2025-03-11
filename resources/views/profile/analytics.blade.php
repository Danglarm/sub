@extends('layouts.nojsapp')
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
            <a href="{{ route('profile') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                Перейти в профиль
            </a>
        </div>
    </form>
    
            
        
</div>

    <!-- График расходов -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-semibold mb-4">График расходов</h2>
        <h2 class="text-xl font-semibold text-right mb-4">Итоговая сумма: ${{ number_format($totalExpenses, 2) }}</h2>
        <canvas id="expensesChart"></canvas>
    </div>

    <!-- Таблица расходов -->
    <section class="container px-4 mx-auto">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                    
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <button class="flex items-center gap-x-2">
                                            <span>Название</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                    <path fill-rule="evenodd" d="M10 3a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v9a2 2 0 0 0 2 2h8a2 2 0 0 1-2-2V3ZM4 4h4v2H4V4Zm4 3.5H4V9h4V7.5Zm-4 3h4V12H4v-1.5Z" clip-rule="evenodd" />
                                                        <path d="M13 5h-1.5v6.25a1.25 1.25 0 1 0 2.5 0V6a1 1 0 0 0-1-1Z" />
                                                </svg>
                                        </button>
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <button class="flex items-center gap-x-2">
                                            <span>Категория</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                                            </svg>
                                        </button>
                                    </th>
                                    <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <button class="flex items-center gap-x-2">
                                            <span>Статус</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                            <path fill-rule="evenodd" d="M15 8c0 .982-.472 1.854-1.202 2.402a2.995 2.995 0 0 1-.848 2.547 2.995 2.995 0 0 1-2.548.849A2.996 2.996 0 0 1 8 15a2.996 2.996 0 0 1-2.402-1.202 2.995 2.995 0 0 1-2.547-.848 2.995 2.995 0 0 1-.849-2.548A2.996 2.996 0 0 1 1 8c0-.982.472-1.854 1.202-2.402a2.995 2.995 0 0 1 .848-2.547 2.995 2.995 0 0 1 2.548-.849A2.995 2.995 0 0 1 8 1c.982 0 1.854.472 2.402 1.202a2.995 2.995 0 0 1 2.547.848c.695.695.978 1.645.849 2.548A2.996 2.996 0 0 1 15 8Zm-3.291-2.843a.75.75 0 0 1 .135 1.052l-4.25 5.5a.75.75 0 0 1-1.151.043l-2.25-2.5a.75.75 0 1 1 1.114-1.004l1.65 1.832 3.7-4.789a.75.75 0 0 1 1.052-.134Z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <button class="flex items-center gap-x-2">
                                            <span>План</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                    <path fill-rule="evenodd" d="M8 1.75a.75.75 0 0 1 .692.462l1.41 3.393 3.664.293a.75.75 0 0 1 .428 1.317l-2.791 2.39.853 3.575a.75.75 0 0 1-1.12.814L7.998 12.08l-3.135 1.915a.75.75 0 0 1-1.12-.814l.852-3.574-2.79-2.39a.75.75 0 0 1 .427-1.318l3.663-.293 1.41-3.393A.75.75 0 0 1 8 1.75Z" clip-rule="evenodd" />
                                                </svg>
                                        </button>
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <button class="flex items-center gap-x-2">
                                            <span>Цена</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                    <path fill-rule="evenodd" d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V3Zm9 3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm-6.25-.75a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5ZM11.5 6A.75.75 0 1 1 13 6a.75.75 0 0 1-1.5 0Z" clip-rule="evenodd" />
                                                    <path d="M13 11.75a.75.75 0 0 0-1.5 0v.179c0 .15-.138.28-.306.255A65.277 65.277 0 0 0 1.75 11.5a.75.75 0 0 0 0 1.5c3.135 0 6.215.228 9.227.668A1.764 1.764 0 0 0 13 11.928v-.178Z" />
                                                </svg>
                                        </button>
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <button class="flex items-center gap-x-2">
                                            <span>Дата начала</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                    <path fill-rule="evenodd" d="M4 1.75a.75.75 0 0 1 1.5 0V3h5V1.75a.75.75 0 0 1 1.5 0V3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2V1.75ZM4.5 6a1 1 0 0 0-1 1v4.5a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-7Z" clip-rule="evenodd" />
                                                </svg>

                                        </button>
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <button class="flex items-center gap-x-2">
                                            <span>Дата окончания</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                <path d="M5.75 7.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5ZM5 10.25a.75.75 0 1 1 1.5 0 .75.75 0 0 1-1.5 0ZM10.25 7.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5ZM7.25 8.25a.75.75 0 1 1 1.5 0 .75.75 0 0 1-1.5 0ZM8 9.5A.75.75 0 1 0 8 11a.75.75 0 0 0 0-1.5Z" />
                                                <path fill-rule="evenodd" d="M4.75 1a.75.75 0 0 0-.75.75V3a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2V1.75a.75.75 0 0 0-1.5 0V3h-5V1.75A.75.75 0 0 0 4.75 1ZM3.5 7a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v4.5a1 1 0 0 1-1 1h-7a1 1 0 0 1-1-1V7Z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                @foreach ($subscriptions as $subscription)
                                <tr>
                                    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                        <h2 class="font-medium text-gray-800 dark:text-white ">{{ $subscription->title }}</h2>
                                    </td>
                                    <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                        <h2 class="font-medium text-gray-800 dark:text-white ">{{ $subscription->category }}</h2>
                                    </td>
                                    <td class="px-12 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                        @if ($subscription->is_active)
                                            <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                <h2 class="text-sm font-normal text-emerald-500">Активный</h2>
                                            </div>
                                        @else
                                            <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 bg-red-100/60 dark:bg-gray-800">
                                                <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                                <h2 class="text-sm font-normal text-red-500">Отменен</h2>
                                            </div>
                                        @endif  
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $subscription->plan }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">${{ number_format($subscription->price, 2) }}</td>
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <div class="flex items-center gap-x-2">
                                            {{ $subscription->start_date->format('Y-m-d') }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <div class="flex items-center gap-x-2">
                                            {{ $subscription->end_date->format('Y-m-d') }}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div> 
</section>
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