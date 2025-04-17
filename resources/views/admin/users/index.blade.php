<!-- Fix the typo at the start of the file -->
<x-app-layout>
    <div class="flex">
        <!-- Sidebar (same as dashboard) -->
        <div class="w-64 min-h-screen bg-[#1B4B5A] text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Hauz Hayag</h1>
            </div>
            <nav class="mt-8">
                <a href="/dashboard" class="block px-4 py-2 hover:bg-[#2C5F6E]">
                    Dashboard
                </a>
                <a href="/users" class="block px-4 py-2 bg-[#1B4B5A] hover:bg-[#2C5F6E] {{ request()->is('users') ? 'bg-[#2C5F6E]' : '' }}">
                    User Management
                </a>
                <a href="/events" class="block px-4 py-2 hover:bg-[#2C5F6E]">
                    Events
                </a>
                <a href="/volunteers" class="block px-4 py-2 hover:bg-[#2C5F6E]">
                    Volunteers
                </a>
                <div class="mt-auto pt-20">
                    <a href="/logout" class="block px-4 py-2 hover:bg-[#2C5F6E]">
                        Logout
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 bg-gray-100">
            <!-- Header -->
            <div class="bg-white p-4 flex justify-between items-center shadow-sm">
                <h2 class="text-xl">User Management</h2>
                <div class="flex items-center space-x-2">
                    <span>Admin</span>
                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-sm">AD</span>
                </div>
            </div>

            <!-- User Management Content -->
            <div class="p-6">
                <!-- Search and Filters -->
                <!-- Update the search and filters section -->
                <div class="flex justify-between items-center mb-6">
                    <div class="flex-1 max-w-md">
                        <form action="{{ route('users.index') }}" method="GET" class="flex gap-4">
                            <input type="text" 
                                name="search" 
                                value="{{ request('search') }}" 
                                placeholder="Search users..." 
                                class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="flex space-x-4">
                        <select name="role" class="px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Roles</option>
                            <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="volunteer" {{ request('role') === 'volunteer' ? 'selected' : '' }}>Volunteer</option>
                            <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
                        </select>
                        <select name="status" class="px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                            Filter
                        </button>
                        </form>
                        <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Add User
                        </a>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="bg-white rounded-lg shadow">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left border-b">
                                <th class="px-6 py-3">
                                    <input type="checkbox" class="rounded">
                                </th>
                                <th class="px-6 py-3 text-sm font-semibold text-gray-600">USER INFO</th>
                                <th class="px-6 py-3 text-sm font-semibold text-gray-600">ROLE</th>
                                <th class="px-6 py-3 text-sm font-semibold text-gray-600">STATUS</th>
                                <th class="px-6 py-3 text-sm font-semibold text-gray-600">JOINED DATE</th>
                                <th class="px-6 py-3 text-sm font-semibold text-gray-600">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="rounded">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gray-200 rounded-full mr-3"></div>
                                        <div>
                                            <div class="font-medium">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-sm rounded-full {{ $user->role === 'Volunteer' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-sm rounded-full {{ $user->status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $user->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <!-- In the actions column of your table -->
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('users.edit', $user) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>