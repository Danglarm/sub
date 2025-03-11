@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">Subscription Details</h2>
    <div class="space-y-4">
        <p><strong>Plan:</strong> {{ $subscription->plan_id }}</p>
        <p><strong>Status:</strong> {{ $subscription->status }}</p>
        <p><strong>Start Date:</strong> {{ $subscription->starts_at->format('Y-m-d') }}</p>
        <p><strong>End Date:</strong> {{ $subscription->ends_at->format('Y-m-d') }}</p>
    </div>
    <a href="{{ route('profile') }}" class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
        Назад

    </a>
</div>
@endsection