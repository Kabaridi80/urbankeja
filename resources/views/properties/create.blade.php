<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">List a New Property</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                @if ($errors->any())
    <div class="bg-red-100 text-red-600 p-4 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-4">
                        <input type="text" name="title" placeholder="Property Title (e.g. Modern 2BD Apartment)" class="rounded-md border-gray-300" required>
                        <textarea name="description" placeholder="Describe the house..." class="rounded-md border-gray-300"></textarea>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <input type="number" name="price" placeholder="Price (KES)" class="rounded-md border-gray-300" required>
                            <select name="type" class="rounded-md border-gray-300">
                                <option value="Apartment">Apartment</option>
                                <option value="Bedsitter">Bedsitter</option>
                                <option value="Studio">Studio</option>
                                <option value="Land">Land/Plot</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <input type="text" name="city" placeholder="City (e.g. Nairobi)" class="rounded-md border-gray-300" required>
                            <input type="text" name="estate" placeholder="Estate (e.g. South C)" class="rounded-md border-gray-300" required>
                            <input type="text" name="landmark" placeholder="Landmark (e.g. Near The Stage)" class="rounded-md border-gray-300" required>
                            <!-- Essential Amenities (Fixed Layout) -->
<div class="mt-8">
    <h3 class="text-lg font-bold text-gray-700 mb-4">Essential Amenities</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 bg-gray-50 p-6 rounded-2xl border border-gray-100">
        
        <!-- Water -->
        <label class="flex items-center gap-3 cursor-pointer group">
            <input type="checkbox" name="has_water" value="1" class="w-5 h-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span class="text-2xl group-hover:scale-110 transition">💧</span>
            <span class="text-sm font-medium text-gray-600">Water</span>
        </label>

        <!-- WiFi -->
        <label class="flex items-center gap-3 cursor-pointer group">
            <input type="checkbox" name="has_wifi" value="1" class="w-5 h-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span class="text-2xl group-hover:scale-110 transition">📶</span>
            <span class="text-sm font-medium text-gray-600">WiFi</span>
        </label>

        <!-- Parking -->
        <label class="flex items-center gap-3 cursor-pointer group">
            <input type="checkbox" name="has_parking" value="1" class="w-5 h-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span class="text-2xl group-hover:scale-110 transition">🚗</span>
            <span class="text-sm font-medium text-gray-600">Parking</span>
        </label>

        <!-- Security -->
        <label class="flex items-center gap-3 cursor-pointer group">
            <input type="checkbox" name="has_security" value="1" class="w-5 h-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span class="text-2xl group-hover:scale-110 transition">🛡️</span>
            <span class="text-sm font-medium text-gray-600">Security</span>
        </label>

    </div>
</div>
                                 <div class="mt-8">
    <label class="block font-bold text-gray-700 mb-2 uppercase text-xs tracking-wider">The Neighborhood Vibe</label>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 bg-blue-50 p-4 rounded-xl border border-blue-100">
        <label class="flex items-center space-x-2 cursor-pointer">
            <input type="checkbox" name="is_quiet" value="1" class="rounded text-blue-600"> 
            <span class="text-sm text-gray-700 font-medium">🤫 Quiet & Private</span>
        </label>
        <label class="flex items-center space-x-2 cursor-pointer">
            <input type="checkbox" name="near_transport" value="1" class="rounded text-blue-600"> 
            <span class="text-sm text-gray-700 font-medium">🚐 Near Stage/Main Road</span>
        </label>
        <label class="flex items-center space-x-2 cursor-pointer">
            <input type="checkbox" name="near_shopping" value="1" class="rounded text-blue-600"> 
            <span class="text-sm text-gray-700 font-medium">🛍️ Near Mall/Market</span>
        </label>
        <label class="flex items-center space-x-2 cursor-pointer">
            <input type="checkbox" name="has_view" value="1" class="rounded text-blue-600"> 
            <span class="text-sm text-gray-700 font-medium">🖼️ Great Scenic View</span>
        </label>
    </div>
</div>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2">Upload House Photo</label>
                            <input type="file" name="images[]" multiple class="w-full" required>
                        </div>

                        <button type="submit" onclick="this.innerHTML='Uploading Keja...'; this.classList.add('opacity-50')" class="bg-blue-600 text-white px-10 py-4 rounded-xl font-bold">
    Post Property
</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>