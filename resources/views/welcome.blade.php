<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UrbanKeja | Premium Listings</title>
    <!-- We use Tailwind CSS for the design -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Font for that "Elegant" look -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
         html {
             scroll-behavior: smooth;
        }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- 1. NAVIGATION BAR -->
    <!-- Optimized Navigation -->
<nav class="bg-white/90 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Brand -->
        <a href="/" class="text-2xl font-extrabold text-blue-600 tracking-tight flex items-center gap-2">
            URBAN<span class="text-gray-900">KEJA</span>
            <span class="bg-blue-100 text-blue-600 text-[10px] uppercase px-2 py-0.5 rounded-full tracking-widest">Verified</span>
        </a>

        <!-- Desktop Links -->
        <div class="hidden md:flex space-x-8 font-semibold text-gray-600 items-center">
           <a href="#services" class="hover:text-blue-600 transition text-sm">Home Services</a>
           <a href="#how-it-works" class="hover:text-blue-600 transition text-sm">How it Works</a>
            
            <!-- We only show Login if the user is a GUEST -->
            @guest
                <a href="/login" class="text-sm text-gray-400 border-l pl-8 hover:text-blue-600">Agent Portal</a>
            @endguest

            <!-- We show Dashboard if they are already logged in -->
            @auth
                <a href="/dashboard" class="text-sm text-blue-600 border-l pl-8 font-bold">My Dashboard</a>
            @endauth
        </div>

        <!-- Action Button -->
        <a href="{{ route('properties.create') }}" class="bg-blue-600 text-white px-6 py-2.5 rounded-full font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 transition flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            List Your Keja
        </a>
    </div>
</nav>

    <!-- 2. HERO SECTION (The Background Image Part) -->
    <div class="relative h-[80vh] min-h-[600px] w-full flex items-center justify-center overflow-hidden">
        <!-- BACKGROUND IMAGE: You can change the URL inside the quotes below -->
        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1920&q=80" 
             class="absolute inset-0 w-full h-full object-cover" alt="Luxury House">
        
        <!-- DARK OVERLAY (Makes text readable) -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-gray-50"></div>

        <!-- HERO CONTENT -->
        <div class="relative z-10 text-center px-4 max-w-4xl">
            <span class="text-blue-400 font-bold tracking-widest uppercase text-sm mb-4 block">Verified Real Estate Kenya</span>
            <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-6 leading-tight">
                Find a home that <br> matches your <span class="text-blue-400">lifestyle.</span>
            </h1>
            
    <!-- ELEGANT SEARCH BOX WITH PRICE FILTER -->
<form action="/" method="GET" class="bg-white p-2 rounded-2xl md:rounded-full shadow-2xl flex flex-col md:flex-row gap-2 max-w-4xl mx-auto items-center">
    
    <!-- Location Search -->
    <div class="flex items-center flex-grow w-full md:w-auto px-4 border-b md:border-b-0 md:border-r border-gray-100">
        <span class="text-gray-400"></span>
        <input type="text" 
               name="search" 
               value="{{ request('search') }}" 
               placeholder="Which estate? (e.g. Thika, Westlands)" 
               class="w-full p-4 focus:outline-none text-gray-700 text-lg bg-transparent">
    </div>

    <!-- Price Range Dropdown -->
    <div class="flex items-center w-full md:w-64 px-4">
        <span class="text-gray-400"></span>
        <select name="price_range" class="w-full p-4 focus:outline-none text-gray-700 bg-transparent cursor-pointer font-semibold">
            <option value="">Any Price</option>
            <option value="0-10000" {{ request('price_range') == '0-10000' ? 'selected' : '' }}>Under 10k</option>
            <option value="10000-20000" {{ request('price_range') == '10000-20000' ? 'selected' : '' }}>10k - 20k</option>
            <option value="20000-40000" {{ request('price_range') == '20000-40000' ? 'selected' : '' }}>20k - 40k</option>
            <option value="40000-1000000" {{ request('price_range') == '40000-1000000' ? 'selected' : '' }}>40k+</option>
        </select>
    </div>

    <!-- Search Button -->
    <button type="submit" class="w-full md:w-auto bg-blue-600 text-white px-10 py-4 rounded-xl md:rounded-full font-bold text-lg hover:bg-blue-700 transition duration-300 shadow-lg shadow-blue-200">
        Search
    </button>
</form>
    </div>
  </div>

    <!-- 3. PROPERTY GRID -->
    <div class="mb-12">
       <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Featured Listings</h2>
    <p class="text-gray-500">Handpicked properties just for you.</p>
    
</div>>

        <!-- LOOP START -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach($properties as $property)
<!-- We wrap the whole div in an anchor tag -->
<a href="/properties/{{ $property->id }}" class="group block bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
    <div class="relative overflow-hidden">
        <!-- Property Image -->
        <img src="{{ asset('storage/' . $property->image) }}" 
             onerror="this.src='https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=800&q=80'"
             class="h-64 w-full object-cover group-hover:scale-105 transition duration-500">
        
        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-lg text-sm font-bold shadow-sm text-blue-600">
            {{ $property->type }}
        </div>
    </div>

    <div class="p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-1 group-hover:text-blue-600 transition">{{ $property->title }}</h3>
        <p class="text-gray-400 text-sm mb-4 flex items-center italic">
             {{ $property->estate }}, {{ $property->city }}
        </p>
        <div class="flex justify-between items-center">
            <span class="text-2xl font-black text-gray-900">Ksh {{ number_format($property->price) }}</span>
            <!-- Button stays for visual cue, but the whole card is now clickable -->
            <span class="bg-gray-100 text-gray-900 px-4 py-2 rounded-xl font-bold group-hover:bg-blue-600 group-hover:text-white transition text-sm">Details</span>
        </div>
    </div>
</a>
            @endforeach
        </div>
        <!-- HOW IT WORKS SECTION -->
<div id="how-it-works" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">How UrbanKeja Works</h2>
            <p class="text-gray-500">Three simple steps to your new home.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
            <!-- Step 1 -->
            <div class="relative">
                <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-6">1</div>
                <h3 class="text-xl font-bold mb-2">Search</h3>
                <p class="text-gray-500 text-sm">Filter houses by estate, price range, and amenities that matter to you.</p>
            </div>

            <!-- Step 2 -->
            <div class="relative">
                <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-6">2</div>
                <h3 class="text-xl font-bold mb-2">Verify & Visit</h3>
                <p class="text-gray-500 text-sm">Our agents are verified. Schedule a visit to see your potential new home.</p>
            </div>

            <!-- Step 3 -->
            <div class="relative">
                <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-6">3</div>
                <h3 class="text-xl font-bold mb-2">Move In</h3>
                <p class="text-gray-500 text-sm">Use our partner movers and cleaners to settle into your new Keja effortlessly.</p>
            </div>
        </div>
    </div>
</div>
      <!-- 4. SERVICES SECTION (Clickable to WhatsApp) -->
<!-- 4. SERVICES SECTION (With Background Image & Clickable WhatsApp) -->
<div id="services" class="relative py-24 mt-20 overflow-hidden bg-gray-900">
    
    <!-- THE BACKGROUND IMAGE -->
    <img src="https://images.unsplash.com/photo-1556912170-453f2c7130e9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" 
         class="absolute inset-0 w-full h-full object-cover" 
         alt="Modern Home Interior">
    
    <!-- DARK GRADIENT OVERLAY (Essential to make text readable) -->
    <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/80 to-gray-900/60"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">Beyond Just a House</h2>
            <p class="text-gray-300 max-w-2xl mx-auto text-lg">We help you settle in. Click any service to chat with our verified partners.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            
            <!-- Security Card (Added backdrop-blur for glass effect) -->
            <a href="https://wa.me/254700000000?text=Hi+UrbanKeja+I+am+enquiring+about+Security+Services" target="_blank" 
               class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20 hover:border-blue-500 hover:bg-white/20 transition-all group block">
                <div class="text-blue-400 mb-6 text-4xl group-hover:scale-110 transition">🛡️</div>
                <h3 class="text-xl font-bold text-white mb-2">Top Security</h3>
                <p class="text-gray-300 text-sm leading-relaxed">CCTV installation and 24/7 guard services for your new home.</p>
            </a>

            <!-- Movers Card -->
            <a href="https://wa.me/254700000000?text=Hi+UrbanKeja+I+am+enquiring+about+Moving+Services" target="_blank" 
               class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20 hover:border-blue-500 hover:bg-white/20 transition-all group block">
                <div class="text-blue-400 mb-6 text-4xl group-hover:scale-110 transition">🚚</div>
                <h3 class="text-xl font-bold text-white mb-2">Professional Movers</h3>
                <p class="text-gray-300 text-sm leading-relaxed">Stress-free moving with our verified "Keja" transport partners.</p>
            </a>

            <!-- Cleaning Card -->
            <a href="https://wa.me/254700000000?text=Hi+UrbanKeja+I+am+enquiring+about+Cleaning+Services" target="_blank" 
               class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20 hover:border-blue-500 hover:bg-white/20 transition-all group block">
                <div class="text-blue-400 mb-6 text-4xl group-hover:scale-110 transition">✨</div>
                <h3 class="text-xl font-bold text-white mb-2">Deep Cleaning</h3>
                <p class="text-gray-300 text-sm leading-relaxed">Professional pre-move cleaning to make your new place sparkle.</p>
            </a>

            <!-- Internet Card -->
            <a href="https://wa.me/254700000000?text=Hi+UrbanKeja+I+am+enquiring+about+Internet+Setup" target="_blank" 
               class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20 hover:border-blue-500 hover:bg-white/20 transition-all group block">
                <div class="text-blue-400 mb-6 text-4xl group-hover:scale-110 transition">📶</div>
                <h3 class="text-xl font-bold text-white mb-2">Fast Internet</h3>
                <p class="text-gray-300 text-sm leading-relaxed">Quick connection to fiber internet providers in your estate.</p>
            </a>

        </div>
    </div>
</div>
</div>

    </div>
<!-- 5. FOOTER -->
<footer class="bg-white pt-16 pb-8 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
        <!-- Brand -->
        <div class="col-span-1 md:col-span-1">
            <div class="text-2xl font-extrabold text-blue-600 mb-4">URBAN<span class="text-gray-900">KEJA</span></div>
            <p class="text-gray-500 text-sm leading-relaxed">
                Nairobi's most trusted property listing platform. Finding your next home shouldn't be a headache.
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h4 class="font-bold text-gray-900 mb-4">Quick Links</h4>
            <ul class="text-gray-500 text-sm space-y-2">
                <li><a href="#" class="hover:text-blue-600">Browse Properties</a></li>
                <li><a href="#" class="hover:text-blue-600">List Your Property</a></li>
                <li><a href="#" class="hover:text-blue-600">Service Partners</a></li>
                <li><a href="/terms" class="hover:text-blue-600">Terms of Service</a></li>
            </ul>
        </div>

        <!-- Support -->
        <div>
            <h4 class="font-bold text-gray-900 mb-4">Get Support</h4>
            <ul class="text-gray-500 text-sm space-y-2">
                <li>Email: <a href="mailto:support@urbankeja.com" class="text-blue-600 font-semibold">support@urbankeja.com</a></li>
                <li>Phone: <a href="tel:+254727400978" class="text-blue-600 font-semibold">+254 727 400 978</a></li>
                <li>WhatsApp: <a href="#" class="text-green-600 font-semibold">Chat with us</a></li>
                <li>Office: Weitethia Hse, Thika</li>
            </ul>
        </div>

        <!-- Recommendation: Newsletter/Trust Badge -->
        <div>
            <h4 class="font-bold text-gray-900 mb-4">Stay Updated</h4>
            <p class="text-gray-500 text-xs mb-4">Get notified when new houses hit the market in your favorite estates.</p>
            <form class="flex gap-2">
                <input type="email" placeholder="Your email" class="bg-gray-100 border-none rounded-lg p-2 text-sm flex-grow focus:ring-2 focus:ring-blue-500">
                <button class="bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-bold">Join</button>
            </form>
        </div>
    </div>

    <!-- Copyright -->
    <div class="max-w-7xl mx-auto px-6 pt-8 border-t border-gray-50 text-center text-gray-400 text-xs">
        <p>© {{ date('Y') }} UrbanKeja Limited. All rights reserved. Made for Nairobi with ❤️</p>
    </div>
</footer>

</body>
</html>