<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UrbanKeja | Find your next home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white p-4 shadow-md flex justify-between items-center">
        <h1 class="text-2xl font-bold text-blue-600 tracking-tight">URBANKEJA</h1>
        <div>
            @auth
                <a href="{{ url('/dashboard') }}" class="text-gray-700 mr-4 font-medium">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-gray-700 mr-4 font-medium">Log in</a>
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md font-bold">Join</a>
            @endauth
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-10 px-4">
        <!-- Search Section -->
<div class="bg-blue-600 py-16 px-4 mb-10">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-4xl font-extrabold text-white mb-4">Find your next Keja in Africa</h1>
        <p class="text-blue-100 mb-8 text-lg">Search for apartments, bedsitters, and land in your favorite estate.</p>
        
        <form action="/" method="GET" class="bg-white p-2 rounded-lg shadow-lg flex flex-col md:flex-row gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by City, Estate or Landmark..." class="flex-grow p-3 rounded-md border-none focus:ring-2 focus:ring-blue-500">
            
            <select name="type" class="p-3 rounded-md border-gray-200 text-gray-600">
                <option value="">All Types</option>
                <option value="Apartment" {{ request('type') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                <option value="Bedsitter" {{ request('type') == 'Bedsitter' ? 'selected' : '' }}>Bedsitter</option>
                <option value="Standalone" {{ request('type') == 'Standalone' ? 'selected' : '' }}>Standalone</option>
                <option value="Land" {{ request('type') == 'Land' ? 'selected' : '' }}>Land/Plot</option>
            </select>

            <button type="submit" class="bg-orange-500 text-white px-8 py-3 rounded-md font-bold hover:bg-orange-600 transition">
                Search
            </button>
        </form>
    </div>
</div>
        <h2 class="text-3xl font-semibold mb-6 text-gray-800">Latest Listings in Africa</h2>
        
        <!-- The Listing Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($properties as $keja)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                    
                    <!-- THE LINE YOU WERE LOOKING FOR IS BELOW: THE LINK TO DETAILS -->
                    <a href="{{ route('properties.show', $keja->id) }}">
                        <img src="{{ asset('storage/' . $keja->image) }}" class="h-48 w-full object-cover hover:opacity-90 transition">
                        
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-blue-600">KES {{ number_format($keja->price) }}</h3>
                            <p class="text-gray-800 font-semibold hover:text-blue-600 transition">{{ $keja->title }}</p>
                            <p class="text-gray-500 text-sm italic">{{ $keja->estate }}, {{ $keja->city }}</p>
                            <p class="text-gray-600 text-sm mt-2 font-medium">📍 {{ $keja->landmark }}</p>
                            
                            <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center text-xs text-gray-400">
                                <span class="bg-gray-100 px-2 py-1 rounded">{{ $keja->type }}</span>
                                <span>{{ $keja->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </a>
                    <!-- END OF LINK -->

                </div>
            @endforeach
        </div>

        @if($properties->isEmpty())
            <div class="text-center py-20 bg-white rounded-lg shadow-sm border border-dashed border-gray-300">
                <p class="text-gray-500 text-xl font-medium">No houses posted yet. Be the first to list a property!</p>
                <a href="{{ route('properties.create') }}" class="mt-4 inline-block text-blue-600 font-bold underline">Post a Keja Now</a>
            </div>
        @endif
    </div>
</body>
</html>