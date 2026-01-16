<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    <!-- THIS IS THE BUTTON PART TO ADD -->
                    <div class="mt-6">
                        <a href="{{ route('properties.create') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 font-bold">
                            + Post a New Keja
                        </a>
                        <a href="{{ route('properties.index') }}" class="inline-block ml-4 bg-gray-800 text-white px-6 py-2 rounded-md hover:bg-gray-900 font-bold">
                         Manage My Listings
                        </a>
                    </div>
                    <!-- END OF BUTTON PART -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>