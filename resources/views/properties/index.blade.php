<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage My Listings</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Image</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($properties as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2"><img src="{{ asset('storage/'.$item->image) }}" class="h-12 w-12 rounded object-cover"></td>
                            <td>{{ $item->title }}</td>
                            <td>KES {{ number_format($item->price) }}</td>
                            <td><span class="text-green-600 font-bold">Live</span></td>
                            <td class="flex space-x-2 mt-2">
                                <a href="{{ route('properties.edit', $item->id) }}" class="text-blue-600 underline">Edit</a>
                                
                                <form action="{{ route('properties.destroy', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 underline" onclick="return confirm('Delete this Keja?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($properties->isEmpty())
                    <p class="py-4 text-gray-500">You haven't posted any houses yet.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>