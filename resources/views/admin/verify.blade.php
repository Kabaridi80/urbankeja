<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('admin.properties') }}" class="text-blue-600 underline text-sm ml-4">
            Monitor All Listings →
        </a>
        <h2 class="font-semibold text-xl text-red-600 leading-tight">
            Admin: Pending Agent Verifications
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <!-- Success Message -->
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg font-bold">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-gray-100">
                            <th class="py-3 px-2">Name</th>
                            <th class="px-2">Email</th>
                            <th class="px-2">Phone</th>
                            <th class="px-2 text-center">Action</th>
                        </tr>
                    </thead>
                   <tbody>
    @foreach($users as $user)
        <tr class="border-b border-gray-50">
            <td class="py-4">{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if($user->is_verified)
                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold">ACTIVE</span>
                @else
                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-bold">PENDING/LOCKED</span>
                @endif
            </td>
            <td>
                <form action="{{ route('admin.user.toggle', $user->id) }}" method="POST">
                    @csrf
                    @if($user->is_verified)
                        <button type="submit" class="bg-red-600 text-white px-4 py-1 rounded text-sm font-bold hover:bg-red-700">
                            Suspend Agent
                        </button>
                    @else
                        <button type="submit" class="bg-green-600 text-white px-4 py-1 rounded text-sm font-bold hover:bg-green-700">
                            Approve Agent
                        </button>
                    @endif
                </form>
                <td>
    <!-- Existing Toggle (Approve/Suspend) Button -->
    <form action="{{ route('admin.user.toggle', $user->id) }}" method="POST" class="inline">
        @csrf
        @if($user->is_verified)
            <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded text-xs font-bold hover:bg-yellow-600">
                Suspend
            </button>
        @else
            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded text-xs font-bold hover:bg-green-700">
                Approve
            </button>
        @endif
    </form>

    <!-- NEW PERMANENT DELETE BUTTON -->
    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="inline ml-2">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-xs font-bold hover:bg-red-700" 
                onclick="return confirm('WARNING: This will permanently delete this agent and ALL their houses. Continue?')">
            Delete Account
        </button>
    </form>
</td>
            </td>
        </tr>
    @endforeach
</tbody>
                </table>

                @if($users->isEmpty())
                    <p class="text-gray-500 py-10 text-center text-lg italic">
                        All caught up! No agents are currently waiting for verification.
                    </p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>