<!-- resources/views/roles/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Details</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    
    @include('components.topbar')

    @include('components.sidebar')

    <!-- Main Content -->
    <div class="ml-64 pt-32 p-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Role Details: {{ $role->name }}</h1>
            <div class="flex gap-2">
                @if(Auth::user()->hasRole('admin'))
                <a href="{{ route('roles.edit', $role->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                    Edit Role
                </a>
                @endif
                <a href="{{ route('roles.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    Back to Roles
                </a>
            </div>
        </div>

        <!-- Role Details Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Role Information</h3>
                    
                    <div class="border rounded-lg overflow-hidden">
                        <table class="w-full">
                            <tr class="border-b">
                                <td class="py-3 px-4 bg-gray-100 font-medium">ID</td>
                                <td class="py-3 px-4">{{ $role->id }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-3 px-4 bg-gray-100 font-medium">Name</td>
                                <td class="py-3 px-4">{{ $role->name }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-3 px-4 bg-gray-100 font-medium">Users Count</td>
                                <td class="py-3 px-4">{{ $role->users->count() }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-3 px-4 bg-gray-100 font-medium">Created At</td>
                                <td class="py-3 px-4">{{ $role->created_at->format('F d, Y h:i A') }}</td>
                            </tr>
                            <tr>
                                <td class="py-3 px-4 bg-gray-100 font-medium">Updated At</td>
                                <td class="py-3 px-4">{{ $role->updated_at ? $role->updated_at->format('F d, Y h:i A') : "Not Updated" }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Permissions ({{ $role->permissions->count() }})</h3>
                    <div class="border rounded-lg p-4 h-full overflow-y-auto" style="max-height: 300px;">
                        @if($role->permissions->count() > 0)
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach($role->permissions as $permission)
                                    <li>{{ $permission->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 italic">No permissions assigned to this role.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Users with this Role -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Users with this Role</h3>
                <div class="border rounded-lg overflow-hidden">
                    @if($role->users->count() > 0)
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-100 border-b">
                                    <th class="py-2 px-4 text-left">ID</th>
                                    <th class="py-2 px-4 text-left">Name</th>
                                    <th class="py-2 px-4 text-left">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($role->users as $user)
                                <tr class="border-b">
                                    <td class="py-2 px-4">{{ $user->id }}</td>
                                    <td class="py-2 px-4">{{ $user->name }}</td>
                                    <td class="py-2 px-4">{{ $user->email }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="p-4 text-gray-500 italic">No users currently have this role assigned.</p>
                    @endif
                </div>
            </div>

            <!-- Delete Button -->
            @if(Auth::user()->hasRole('admin'))
            <div class="mt-6 flex justify-end">
                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this role? This will remove the role from all assigned users.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                        Delete Role
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>

    <!-- JavaScript for Dropdown Menu -->
    <script>
        document.getElementById('profile-menu').addEventListener('click', function() {
            document.getElementById('menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>