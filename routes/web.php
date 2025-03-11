<?php

use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ProfileController;





Route::get('/', function () {
    return view('welcome');
});




// Регистрация
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Вход
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Восстановление пароля
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');


// Профиль (требует аутентификации)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});








Route::middleware('auth')->group(function () {
    // Создание подписки
    Route::get('/subscriptions/create', [SubscriptionController::class, 'createForm'])->name('subscriptions.create.form');
    Route::post('/subscriptions', [SubscriptionController::class, 'create'])->name('subscriptions.create');

    // История подписок
    Route::get('/subscriptions', [SubscriptionController::class, 'history'])->name('subscriptions.history');

  


  // Отмена подписки
  Route::delete('/subscriptions/{id}/cancel', [SubscriptionController::class, 'cancel'])->name('subscriptions.cancel');

  // Форма изменения тарифного плана
  Route::get('/subscriptions/{id}/change-plan', [SubscriptionController::class, 'changePlanForm'])->name('subscriptions.change-plan.form');

  // Изменение тарифного плана
  Route::put('/subscriptions/{id}/change-plan', [SubscriptionController::class, 'changePlan'])->name('subscriptions.change-plan');

  // Продление подписки
  Route::post('/subscriptions/{id}/renew', [SubscriptionController::class, 'renew'])->name('subscriptions.renew');


  Route::post('/subscriptions/{id}/resume', [SubscriptionController::class, 'resume'])->name('subscriptions.resume');


    // Получение информации о подписке
    Route::get('/subscriptions/{id}', [SubscriptionController::class, 'show'])->name('subscriptions.show');


    
});