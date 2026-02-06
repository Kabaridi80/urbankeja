<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-600 leading-tight">Admin: All Live Listings</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-gray-100">
                            <th class="py-3">Image</th>
                            <th>Title</th>
                            <th>Agent</th>
                            <th>Price</th>
                            <th>Posted On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($properties as $house)
                            <tr class="border-b border-gray-50 hover:bg-gray-50">
                                <td class="py-2"><img src="{{ asset('storage/'.$house->image) }}" class="h-10 w-10 rounded object-cover"></td>
                                <td class="font-medium">{{ $house->title }}</td>
                                <td class="text-blue-600 text-sm">{{ $house->user->name }}</td>
                                <td>KES {{ number_format($house->price) }}</td>
                                <td class="text-xs text-gray-400">{{ $house->created_at->format('d M, Y') }}</td>
                                <td>
                                    <form action="{{ route('admin.properties.destroy', $house->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 text-xs font-bold uppercase hover:underline" onclick="return confirm('Delete this house from the whole site?')">
                                            Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($properties->isEmpty())
                    <p class="text-center py-10 text-gray-500">No properties have been listed yet.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>