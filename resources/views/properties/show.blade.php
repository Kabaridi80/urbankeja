<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} | UrbanKeja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50">

    <!-- Simple Nav -->
    <nav class="bg-white border-b border-gray-100 py-4 mb-10">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <a href="/" class="text-xl font-extrabold text-blue-600">URBAN<span class="text-gray-900">KEJA</span></a>
            <a href="/" class="text-sm font-bold text-gray-500 hover:text-blue-600">← Back to Search</a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- LEFT: IMAGE (Cloudinary Fix) -->
            <!-- LEFT: GALLERY SECTION -->
<div class="lg:col-span-2">
    
    <!-- 1. The Main Image (The one people see first) -->
    <div class="rounded-3xl overflow-hidden shadow-sm bg-white border border-gray-100">
        <img id="mainImage" 
             src="{{ $property->image }}" 
             onerror="this.src='https://via.placeholder.com/800x600?text=UrbanKeja+Image'"
             class="w-full h-[500px] object-cover transition-all duration-300" 
             alt="{{ $property->title }}">
    </div>

    <!-- 2. The Thumbnails (Only shows if you uploaded more than one photo) -->
    @if($property->images->count() > 1)
    <div class="grid grid-cols-4 md:grid-cols-6 gap-4 mt-6">
        @foreach($property->images as $img)
        <div class="aspect-square rounded-2xl overflow-hidden border-2 border-transparent hover:border-blue-500 transition-all cursor-pointer shadow-sm bg-gray-100">
            <img src="{{ $img->image_path }}" 
                 onclick="document.getElementById('mainImage').src='{{ $img->image_path }}'"
                 class="w-full h-full object-cover"
                 alt="Keja thumbnail">
        </div>
        @endforeach
    </div>
    <p class="text-xs text-gray-400 mt-2 italic">Click a thumbnail to view photo</p>
    @endif

    <!-- Description (Should already be here, keep it below the gallery) -->
    <div class="mt-8 bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Description</h2>
        <p class="text-gray-600 leading-relaxed">{{ $property->description }}</p>
    </div>
</div>

            <!-- RIGHT: SIDEBAR (Double Text Fix) -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 sticky top-10">
                    <!-- 1. Title -->
                    <h1 class="text-3xl font-black text-gray-900 mb-2">{{ ucfirst($property->title) }}</h1>
                    
                    <!-- 2. Price -->
                    <p class="text-3xl font-bold text-blue-600 mb-6">KES {{ number_format($property->price) }}</p>

                    <hr class="mb-6 border-gray-50">

                    <!-- 3. Details List -->
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Category:</span>
                            <span class="font-bold text-gray-900">{{ $property->type }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Location:</span>
                            <span class="font-bold text-gray-900">{{ $property->estate }}, {{ ucfirst($property->city) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Landmark:</span>
                            <span class="font-bold text-gray-900">{{ $property->landmark }}</span>
                        </div>
                    </div>

                    <!-- 4. Contact Buttons -->
                    <div class="space-y-3">
                        <a href="https://wa.me/254727400978?text=Hi+UrbanKeja+I+am+interested+in+the+{{ $property->title }}" 
                           target="_blank"
                           class="flex items-center justify-center gap-2 w-full bg-green-500 text-white py-4 rounded-2xl font-bold hover:bg-green-600 transition">
                            Chat on WhatsApp
                        </a>
                        <a href="tel:+254727400978" class="flex items-center justify-center gap-2 w-full bg-gray-900 text-white py-4 rounded-2xl font-bold hover:bg-black transition">
                            Call Agent
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </main>
</body>
</html>