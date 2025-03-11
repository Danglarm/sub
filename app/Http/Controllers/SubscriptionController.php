<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{



 // Отмена подписки
 public function cancel($id)
 {
     $subscription = Subscription::findOrFail($id);
     $subscription->update(['is_active' => false]);

     return redirect()->route('subscriptions.history')->with('success', 'Subscription cancelled successfully!');
 }







// Возобновление подписки
public function resume($id)
{
    $subscription = Subscription::findOrFail($id);

    // Проверяем, что подписка была отменена
    if (!$subscription->is_active) {
        $subscription->update([
            'is_active' => true,
            'end_date' => now()->addMonth(), // Пример: возобновление на 1 месяц
        ]);

        return redirect()->route('subscriptions.history')->with('success', 'Subscription resumed successfully!');
    }

    return redirect()->route('subscriptions.history')->with('error', 'Subscription is already active.');
}










 // Форма изменения тарифного плана
 public function changePlanForm($id)
 {
     $subscription = Subscription::findOrFail($id);
     return view('subscriptions.change-plan', compact('subscription'));
 }

 // Изменение тарифного плана
 public function changePlan(Request $request, $id)
 {
     $request->validate([
         'plan' => 'required|string',
         'price' => 'required|numeric',
     ]);

     $subscription = Subscription::findOrFail($id);
     $subscription->update([
         'plan' => $request->plan,
         'price' => $request->price,
     ]);

     return redirect()->route('subscriptions.history')->with('success', 'Plan changed successfully!');
 }

 // Продление подписки
 public function renew($id)
 {
     $subscription = Subscription::findOrFail($id);
     $subscription->update([
         'end_date' => $subscription->end_date->addMonth(), // Пример: продление на 1 месяц
     ]);

     return redirect()->route('subscriptions.history')->with('success', 'Subscription renewed successfully!');
 }







    public function createForm()
    {
        return view('subscriptions.create');
    }
    // Создание подписки
    public function create(Request $request)
    {

        
        $request->validate([
            'plan' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $user = Auth::user();

        $subscription = $user->subscriptions()->create([
            'plan' => $request->plan,
            'title' => $request->title, // Сохранение названия подписки
            'price' => $request->price,
            'start_date' => now(),
            'end_date' => now()->addMonth(), // Пример: подписка на 1 месяц
        ]);

        return redirect()->route('subscriptions.history')->with('success', 'Subscription created successfully!');
    }



   

    // Получение информации о подписке
    public function show($id)
    {
        $subscription = Subscription::findOrFail($id);
        return response()->json(['subscription' => $subscription]);
    }

    // Получение истории подписок пользователя
    public function history()
    {
        $user = Auth::user();
        $subscriptions = $user->subscriptions()->orderBy('created_at', 'desc')->get();
    
        return view('subscriptions.history', compact('subscriptions'));
    }


    public function update(Request $request, $id)
{
    $subscription = Subscription::findOrFail($id);

    $request->validate([
        'title' => 'sometimes|string|max:255', // Валидация названия подписки
        'plan' => 'sometimes|string',
    ]);

    if ($request->has('title')) {
        $subscription->title = $request->title;
    }

    if ($request->has('plan')) {
        $subscription->plan = $request->plan;
    }

    $subscription->save();

    return response()->json(['message' => 'Subscription updated!', 'subscription' => $subscription]);
}
}
