<!DOCTYPE html>
<html>
<head>
    <title>UrbanKeja | Agent Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-10">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Agent Management</h1>
            <a href="/" class="text-blue-600 font-bold">← Back to Site</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-6 text-sm font-bold text-gray-400 uppercase">Agent</th>
                        <th class="p-6 text-sm font-bold text-gray-400 uppercase">Status</th>
                        <th class="p-6 text-sm font-bold text-gray-400 uppercase text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agents as $agent)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="p-6">
                            <p class="font-bold text-gray-900">{{ $agent->name }}</p>
                            <p class="text-sm text-gray-400">{{ $agent->email }}</p>
                        </td>
                        <td class="p-6">
                            @if($agent->is_verified)
                                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-bold uppercase">Verified</span>
                            @else
                                <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-bold uppercase">Pending</span>
                            @endif
                        </td>
                        <td class="p-6 text-right space-x-4">
                            @if(!$agent->is_verified)
                            <form action="{{ route('admin.agents.verify', $agent->id) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button class="text-blue-600 font-bold hover:underline">Verify</button>
                            </form>
                            @endif

                            <form action="{{ route('admin.agents.destroy', $agent->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 font-bold hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="p-10 text-center text-gray-400 italic">No agents found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>