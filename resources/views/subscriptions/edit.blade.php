<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">Edit Subscription</h2>
    <form action="{{ route('subscriptions.update', $subscription->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Subscription Title</label>
            <input type="text" name="title" id="title" value="{{ $subscription->title }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        </div>
        <div class="mb-4">
            <label for="plan_id" class="block text-sm font-medium text-gray-700">Select Plan</label>
            <select name="plan_id" id="plan_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                <option value="basic" {{ $subscription->plan_id === 'basic' ? 'selected' : '' }}>Basic Plan</option>
                <option value="premium" {{ $subscription->plan_id === 'premium' ? 'selected' : '' }}>Premium Plan</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
            Update Subscription
        </button>
    </form>
</div>