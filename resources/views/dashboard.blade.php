<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-6 text-gray-900">
    @if(auth()->user()->is_verified)
        <h3 class="text-lg font-bold text-green-600 mb-4">✅ Your account is Verified</h3>
        <a href="{{ route('properties.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-md font-bold hover:bg-blue-700">
            + Post a New Keja
        </a>
    @else
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
            <div class="flex">
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        <strong>Account Pending:</strong> You cannot post houses yet. Please send your ID/Business documents to 
                        <span class="font-bold">admin@urbankeja.com</span> for verification.
                    </p>
                </div>
            </div>
        </div>
    @endif

    <div class="mt-8">
        <a href="{{ route('properties.index') }}" class="text-gray-600 underline">Manage My Listings</a>
    </div>
</div>
</x-app-layout>