<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
</head>
<body class="bg-white font-[Plus+Jakarta+Sans]">
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Left Side: Marketing -->
        <!-- Left Side: Marketing with Background Image -->
<div class="relative md:w-1/2 flex flex-col justify-center p-12 text-white overflow-hidden">
    
    <!-- BACKGROUND IMAGE -->
    <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=1000&q=80" 
         class="absolute inset-0 w-full h-full object-cover" alt="Real Estate Background">
    
    <!-- BRANDED OVERLAY (This keeps your Blue identity while showing the image) -->
    <div class="absolute inset-0 bg-blue-700/80 mix-blend-multiply"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-blue-900 via-transparent to-blue-800/50"></div>

    <!-- CONTENT (Relative z-10 ensures it sits on top of the image) -->
    <div class="relative z-10">
        <div class="mb-8">
            <span class="bg-white/20 backdrop-blur-md px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest">
                Partner with UrbanKeja
            </span>
        </div>
        
        <h1 class="text-5xl md:text-6xl font-black mb-6 leading-tight">
            List your Keja <br> where it <span class="text-blue-300">matters.</span>
        </h1>
        
        <p class="text-blue-50 text-xl mb-10 leading-relaxed max-w-md">
            Join Nairobi's fastest-growing verified property network. Get more serious inquiries and less "window shoppers."
        </p>
        
        <ul class="space-y-6">
            <li class="flex items-center gap-4 bg-white/10 backdrop-blur-sm p-4 rounded-2xl border border-white/10 hover:bg-white/20 transition cursor-default">
                <span class="text-2xl"></span> 
                <div>
                    <p class="font-bold">Verified Agent Badge</p>
                    <p class="text-sm text-blue-100 italic">Build instant trust with tenants.</p>
                </div>
            </li>
            <li class="flex items-center gap-4 bg-white/10 backdrop-blur-sm p-4 rounded-2xl border border-white/10 hover:bg-white/20 transition cursor-default">
                <span class="text-2xl"></span> 
                <div>
                    <p class="font-bold">Track Listing Views</p>
                    <p class="text-sm text-blue-100 italic">See how many people click your house.</p>
                </div>
            </li>
            <li class="flex items-center gap-4 bg-white/10 backdrop-blur-sm p-4 rounded-2xl border border-white/10 hover:bg-white/20 transition cursor-default">
                <span class="text-2xl"></span> 
                <div>
                    <p class="font-bold">Direct WhatsApp Inquiries</p>
                    <p class="text-sm text-blue-100 italic">Tenants chat with you instantly.</p>
                </div>
            </li>
        </ul>
    </div>
</div>

        <!-- Right Side: Choice -->
        <div class="md:w-1/2 p-12 flex flex-col justify-center text-center">
            <div class="max-w-sm mx-auto">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Welcome Back</h2>
                <p class="text-gray-500 mb-10">Ready to find a tenant for your property?</p>

                <div class="space-y-4">
                    <a href="/login" class="block w-full bg-blue-600 text-white py-4 rounded-2xl font-bold hover:bg-blue-700 transition">Login to Dashboard</a>
                    <a href="/register" class="block w-full bg-gray-100 text-gray-900 py-4 rounded-2xl font-bold hover:bg-gray-200 transition">Create New Agent Account</a>
                </div>
                
                <a href="/" class="mt-10 block text-sm text-gray-400 hover:text-blue-600">Back to UrbanKeja Home</a>
            </div>
        </div>
    </div>
</body>
</html>