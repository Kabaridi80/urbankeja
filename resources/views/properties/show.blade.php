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
       <!-- Image & Gallery Section -->
    <div class="space-y-4">
    <!-- Main Large Image -->
      <div class="relative h-96 w-full overflow-hidden rounded-lg shadow-lg">
          <img id="mainImage" src="{{ asset('storage/' . $property->image) }}" 
              class="w-full h-full object-cover transition duration-500 ease-in-out">
    </div>

    <!-- Thumbnails Grid -->
        <div class="grid grid-cols-4 gap-2">
          <!-- We include the main image as the first thumbnail -->
          <div class="cursor-pointer border-2 border-blue-600 rounded-md overflow-hidden thumbnail-box" 
               onclick="changeImage('{{ asset('storage/' . $property->image) }}', this)">
              <img src="{{ asset('storage/' . $property->image) }}" class="h-20 w-full object-cover">
         </div>

        <!-- Loop through the extra images -->
        @foreach($property->images as $extraImage)
            <div class="cursor-pointer border-2 border-transparent hover:border-blue-400 rounded-md overflow-hidden thumbnail-box" 
                 onclick="changeImage('{{ asset('storage/' . $extraImage->image_path) }}', this)">
                <img src="{{ asset('storage/' . $extraImage->image_path) }}" class="h-20 w-full object-cover">
            </div>
        @endforeach
    </div>
</div>

<!-- Simple JavaScript to swap the images -->
<script>
    function changeImage(src, element) {
        // Change the main image source
        document.getElementById('mainImage').src = src;

        // Remove the blue border from all thumbnails
        document.querySelectorAll('.thumbnail-box').forEach(box => {
            box.classList.remove('border-blue-600');
            box.classList.add('border-transparent');
        });

        // Add blue border to the clicked thumbnail
        element.classList.add('border-blue-600');
        element.classList.remove('border-transparent');
    }
</script>
        <!-- Info Section -->
        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100">
            <!-- Info Section -->
<div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100">
    
    <!-- PASTE THE VIBE TAGS CODE HERE -->
    <div class="flex flex-wrap gap-2 mb-4">
        @if($property->is_quiet) 
            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded text-xs font-bold uppercase tracking-tight">🤫 Quiet Neighborhood</span> 
        @endif
        @if($property->near_transport) 
            <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded text-xs font-bold uppercase tracking-tight">🚐 Easy Commute</span> 
        @endif
        @if($property->near_shopping) 
            <span class="bg-pink-100 text-pink-700 px-3 py-1 rounded text-xs font-bold uppercase tracking-tight">🛍️ Near Shops/Mall</span> 
        @endif
        @if($property->has_view) 
            <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded text-xs font-bold uppercase tracking-tight">🖼️ Scenic View</span> 
        @endif
    </div>
    <!-- END OF VIBE TAGS -->

    <!-- Your existing Title and Price section follows -->
    <h1 class="text-3xl font-bold text-gray-900">{{ $property->title }}</h1>
    <p class="text-2xl text-blue-600 font-bold mt-2">KES {{ number_format($property->price) }}</p>
    
    ...
            <h1 class="text-3xl font-bold text-gray-900">{{ $property->title }}</h1>
            <p class="text-2xl text-blue-600 font-bold mt-2">KES {{ number_format($keja->price ?? $property->price) }}</p>
            
            <div class="mt-6 space-y-4">
                <p class="text-gray-600"><span class="font-bold text-gray-800">Category:</span> {{ $property->type }}</p>
                <p class="text-gray-600"><span class="font-bold text-gray-800">Location:</span> {{ $property->estate }}, {{ $property->city }}</p>
                <p class="text-gray-600"><span class="font-bold text-gray-800">Landmark:</span> {{ $property->landmark }}</p>
            </div>
               <div class="mt-8 pt-6 border-t border-gray-100">
    <h3 class="text-lg font-bold text-gray-800 mb-4">Property Amenities</h3>
    <div class="flex flex-wrap gap-3">
        @if($property->has_water) 
            <span class="bg-blue-50 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold border border-blue-100">💧 Water/Borehole</span> 
        @endif
        @if($property->has_wifi) 
            <span class="bg-indigo-50 text-indigo-700 px-4 py-2 rounded-full text-sm font-semibold border border-indigo-100">📶 High-speed WiFi</span> 
        @endif
        @if($property->has_parking) 
            <span class="bg-gray-50 text-gray-700 px-4 py-2 rounded-full text-sm font-semibold border border-gray-100">🚗 Secure Parking</span> 
        @endif
        @if($property->has_security) 
            <span class="bg-green-50 text-green-700 px-4 py-2 rounded-full text-sm font-semibold border border-green-100">🛡️ 24/7 Security</span> 
        @endif
    </div>
</div>

            <hr class="my-6">

            <h3 class="font-bold text-gray-800 mb-2">Description</h3>
            <p class="text-gray-600 leading-relaxed">{{ $property->description }}</p>

            <div class="mt-8 p-4 bg-gray-50 rounded-lg border border-gray-100 flex items-center">
    <div class="h-12 w-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
        {{ substr($property->user->name, 0, 1) }}
    </div>
    <div>
        <p class="text-sm text-gray-500 italic">Listed by Agent:</p>
        <p class="font-bold text-gray-900 text-lg">{{ $property->user->name }}</p>
    </div>
</div>

<!-- Updated WhatsApp Button using the REAL Agent Phone -->
<div class="mt-4">
    @php
        $message = urlencode("Hello " . $property->user->name . ", I'm interested in your property: " . $property->title . " in " . $property->estate . ". Is it still available?");
        // We clean the phone number to make sure it works for WhatsApp (removes any '+' or spaces)
        $cleanPhone = preg_replace('/[^0-9]/', '', $property->user->phone);
    @endphp
    
    <a href="https://wa.me/{{ $cleanPhone }}?text={{ $message }}" target="_blank" 
       class="block w-full bg-green-500 text-white text-center py-4 rounded-lg font-bold text-lg hover:bg-green-600 transition shadow-lg">
       Chat with {{ $property->user->name }} on WhatsApp
    </a>
</div>

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