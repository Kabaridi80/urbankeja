<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage My Listings | UrbanKeja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50 p-6 md:p-12">
    <div class="max-w-5xl mx-auto">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-black text-gray-900">My Kejas</h1>
                <p class="text-gray-500">Manage your property listings</p>
            </div>
            <a href="/dashboard" class="text-blue-600 font-bold hover:underline">← Back to Dashboard</a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-8 p-4 bg-green-100 border border-green-200 text-green-700 rounded-2xl font-bold flex items-center gap-2">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif

        <!-- Listings Grid -->
        <div class="grid gap-6">
            @forelse($properties as $property)
            <div class="bg-white p-5 rounded-3xl shadow-sm border border-gray-100 flex flex-col md:flex-row items-center gap-6 hover:shadow-md transition">
                
                <!-- Property Image Thumbnail -->
                <div class="w-full md:w-32 h-24 rounded-2xl overflow-hidden bg-gray-100 flex-shrink-0">
                    <img src="{{ $property->image }}" onerror="this.src='https://via.placeholder.com/150?text=House'" class="w-full h-full object-cover">
                </div>
                
                <!-- Property Info -->
                <div class="flex-grow text-center md:text-left">
                    <h3 class="text-lg font-bold text-gray-900">{{ $property->title }}</h3>
                    <p class="text-gray-400 text-sm italic">{{ $property->estate }}, Ksh {{ number_format($property->price) }}</p>
                    <div class="mt-2 flex justify-center md:justify-start gap-2">
                         <span class="px-2 py-0.5 bg-blue-50 text-blue-600 text-[10px] font-black uppercase rounded">{{ $property->type }}</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <!-- View Button -->
                    <a href="{{ route('properties.show', $property->id) }}" class="p-3 bg-gray-50 text-gray-400 rounded-xl hover:text-blue-600 transition" title="View Public Page">
                        👁️
                    </a>

                    <!-- Delete Button -->
                    <form action="{{ route('properties.destroy', $property->id) }}" method="POST" onsubmit="return confirm('Wait! Are you sure you want to delete this Keja forever?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-6 py-3 bg-red-50 text-red-600 rounded-xl font-bold hover:bg-red-600 hover:text-white transition">
                            Delete Listing
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <!-- Empty State -->
            <div class="text-center py-20 bg-white rounded-[40px] border-2 border-dashed border-gray-200">
                <p class="text-gray-400 text-lg">You haven't listed any houses yet.</p>
                <a href="{{ route('properties.create') }}" class="mt-4 inline-block bg-blue-600 text-white px-8 py-3 rounded-2xl font-bold hover:bg-blue-700 transition">
                    List your first Keja
                </a>
            </div>
            @endforelse
        </div>
    </div>
</body>
</html>