@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Cancel Subscription</h1>
        <form action="{{ route('subscriptions.cancel', $subscription->id) }}" method="POST">
            @csrf
            <p class="mb-4">Are you sure you want to cancel your subscription?</p>
            <button type="submit"
                    class="w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                Cancel Subscription
            </button>
        </form>
    </div>
</div>
@endsection