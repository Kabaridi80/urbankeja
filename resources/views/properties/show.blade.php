<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} | UrbanKeja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white p-4 shadow-sm">
        <div class="max-w-6xl mx-auto">
            <a href="/" class="text-blue-600 font-bold text-xl">← Back to UrbanKeja</a>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto py-10 px-4 grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Image Section -->
        <div>
            <img src="{{ asset('storage/' . $property->image) }}" class="w-full rounded-lg shadow-lg object-cover h-96">
        </div>

        <!-- Info Section -->
        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100">
            <h1 class="text-3xl font-bold text-gray-900">{{ $property->title }}</h1>
            <p class="text-2xl text-blue-600 font-bold mt-2">KES {{ number_format($property->price) }}</p>
            
            <div class="mt-6 space-y-4">
                <p class="text-gray-600"><span class="font-bold text-gray-800">Category:</span> {{ $property->type }}</p>
                <p class="text-gray-600"><span class="font-bold text-gray-800">Location:</span> {{ $property->estate }}, {{ $property->city }}</p>
                <p class="text-gray-600"><span class="font-bold text-gray-800">Landmark:</span> {{ $property->landmark }}</p>
            </div>

            <hr class="my-6">

            <h3 class="font-bold text-gray-800 mb-2">Description</h3>
            <p class="text-gray-600 leading-relaxed">{{ $property->description }}</p>

            <!-- WhatsApp Button (The African Essential) -->
            <div class="mt-8">
                @php
                    $message = urlencode("Hello, I'm interested in the property: " . $property->title . " in " . $property->estate . ". Is it still available?");
                @endphp
              <a href="https://wa.me/{{ $property->user->phone ?? '254700000000' }}?text={{ $message }}" 
                  target="_blank" 
                  class="block w-full bg-green-500 text-white text-center py-4 rounded-lg font-bold text-lg hover:bg-green-600 transition">
                 Chat with Agent on WhatsApp
             </a>
                <p class="text-xs text-gray-400 text-center mt-2 font-medium italic">* Mention you found it on UrbanKeja</p>
            </div>
        </div>
    </div>
</body>
</html>