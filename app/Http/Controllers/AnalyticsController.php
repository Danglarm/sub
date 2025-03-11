<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Фильтрация по категории
        $category = $request->input('category');
        // Фильтрация по периоду
        $period = $request->input('period', 'week'); // По умолчанию — неделя

        $query = Subscription::where('user_id', $user->id);

        if ($category) {
            $query->where('category', $category);
        }

        // Фильтрация по периоду
        if ($period === 'week') {
            $query->whereBetween('start_date', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($period === '2weeks') {
            $query->whereBetween('start_date', [now()->subWeeks(2)->startOfWeek(), now()->endOfWeek()]);
        } elseif ($period === 'month') {
            $query->whereBetween('start_date', [now()->startOfMonth(), now()->endOfMonth()]);
        } elseif ($period === 'year') {
            $query->whereBetween('start_date', [now()->startOfYear(), now()->endOfYear()]);
        }

        $subscriptions = $query->get();

        // Расчет общей суммы расходов
        $totalExpenses = $subscriptions->sum('price');

        // Группировка по категориям для графика
        $expensesByCategory = $subscriptions->groupBy('category')->map(function ($items) {
            return $items->sum('price');
        });

        // Получение уникальных категорий из базы данных
        $categories = Subscription::where('user_id', $user->id)
            ->distinct('category')
            ->pluck('category');

        return view('profile.analytics', [
            'subscriptions' => $subscriptions,
            'totalExpenses' => $totalExpenses,
            'expensesByCategory' => $expensesByCategory,
            'categories' => $categories, // Список категорий из базы данных
            'selectedCategory' => $category,
            'selectedPeriod' => $period,
        ]);
    }
}