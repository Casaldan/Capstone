<x-app-layout>
    <!-- Sidebar -->
    <div class="flex">
        <div class="w-64 min-h-screen bg-[#1B4B5A] text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Hauz Hayag</h1>
            </div>
            <nav class="mt-8">
                <a href="/users" class="block px-4 py-2 hover:bg-[#2C5F6E]">
                    User Management
                </a>
                <a href="/volunteers" class="block px-4 py-2 hover:bg-[#2C5F6E]">
                    Volunteers
                </a>

                <a href="/students" class="block px-4 py-2 hover:bg-[#2C5F6E]">
                    Students
                </a>
                <a href="/events" class="block px-4 py-2 hover:bg-[#2C5F6E]">
                    Events
                </a>
                <div class="mt-auto pt-20">
                    
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 bg-gray-100">
            <!-- Header -->
            <div class="bg-white p-4 flex justify-between items-center shadow-sm">
                <h2 class="text-xl">Dashboard Overview</h2>
                <div class="flex items-center space-x-2">
                    <span>Admin</span>
                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-sm">AD</span>
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Total Users -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600">Total Users</p>
                                <h3 class="text-2xl font-bold mt-1">{{ $totalUsers }}</h3>
                                <!-- <p class="text-xs text-green-500 mt-1">{{ $userIncrease }}% increase</p> -->
                            </div>
                            <span class="bg-blue-100 p-2 rounded-full">
                                <!-- User Icon -->
                            </span>
                        </div>
                    </div>

                    <!-- Active Volunteers -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600">Active Volunteers</p>
                                <h3 class="text-2xl font-bold mt-1">{{ $activeVolunteers }}</h3>
                                <!-- <p class="text-xs text-green-500 mt-1">{{ $volunteerIncrease }}% increase</p> -->
                            </div>
                            <span class="bg-green-100 p-2 rounded-full">
                                <!-- Volunteer Icon -->
                            </span>
                        </div>
                    </div>

                    <!-- Upcoming Events -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600">Upcoming Events</p>
                                <h3 class="text-2xl font-bold mt-1">8</h3>
                                <p class="text-xs text-purple-500 mt-1">Next 7 Days</p>
                            </div>
                            <span class="bg-purple-100 p-2 rounded-full">
                                <!-- Calendar Icon -->
                            </span>
                        </div>
                    </div>

                    <!-- Pending Applications -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600">Pending Applications</p>
                                <h3 class="text-2xl font-bold mt-1">25</h3>
                                <p class="text-xs text-yellow-500 mt-1">Requires Action</p>
                            </div>
                            <span class="bg-yellow-100 p-2 rounded-full">
                                <!-- Document Icon -->
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Recent Users and Upcoming Events -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                    <!-- Recent Users -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Recent Users</h3>
                        <table class="w-full">
                            <thead>
                                <tr class="text-left text-sm text-gray-500">
                                    <th class="pb-3">USER</th>
                                    <th class="pb-3">ROLE</th>
                                    <th class="pb-3">STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentUsers as $user)
                                <tr class="border-t">
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            @if($user->profile_picture)
                                                <img src="{{ Storage::url($user->profile_picture) }}" alt="{{ $user->name }}" class="w-8 h-8 rounded-full object-cover mr-3">
                                            @else
                                                <div class="w-8 h-8 bg-gray-200 rounded-full mr-3 flex items-center justify-center">
                                                    <span class="text-gray-500 text-sm">{{ substr($user->name, 0, 1) }}</span>
                                                </div>
                                            @endif
                                            <div>
                                                <p class="font-medium">{{ $user->name }}</p>
                                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3">{{ ucfirst($user->role) }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 text-xs rounded-full {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $user->status }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Upcoming Events -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Upcoming Events</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex-shrink-0"></div>
                                <div>
                                    <h4 class="font-medium">Community Cleanup Drive</h4>
                                    <p class="text-sm text-gray-500">Tomorrow at 9:00 AM</p>
                                    <p class="text-sm text-gray-500">12 volunteers registered</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>