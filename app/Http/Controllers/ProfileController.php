<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $subscriptions = $user->subscriptions()->orderBy('created_at', 'desc')->get();
        return view('profile.show', compact('user', 'subscriptions'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);
    
        $user->name = $request->name;
        $user->email = $request->email;
    
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
    
        $user->save();
    
        // Редирект на страницу профиля с сообщением об успехе
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    public function edit()
{
    $user = Auth::user();
    return view('profile.edit', compact('user'));
}
}
