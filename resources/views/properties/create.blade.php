<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">List a New Property</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
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
                        </div>

                        <div>
                            <label class="block mb-2">Upload House Photo</label>
                            <input type="file" name="image" class="w-full" required>
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 w-40">Post Keja</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>