<!-- resources/views/roles/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    
    @include('components.topbar')

    @include('components.sidebar')

    <!-- Success Panel -->
    @if(session('success'))
    <div class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg">
        {{ session('success') }}
    </div>
    @endif

    <!-- Errors Panel -->
    @if($errors->any())
    <div class="fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Main Content -->
    <div class="ml-64 pt-32 p-6">
        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500">Total Roles</h3>
                <p class="text-2xl font-bold">{{$countRoles}}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500">Users with Roles</h3>
                <p class="text-2xl font-bold">{{$activeRoles}}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500">Latest Role</h3>
                <p class="text-2xl font-bold">{{$latestRole}}</p>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Roles</h2>
                <div class="flex gap-4">
                    <input type="text" placeholder="Search..." class="px-4 py-2 border rounded-lg">
                    @if(Auth::user()->hasRole('admin'))
                    <a href="{{ route('roles.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Create New Role
                    </a>
                    @endif
                </div>
            </div>
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="py-2">ID</th>
                        <th class="py-2">Name</th>
                        <th class="py-2">Permissions</th>
                        <th class="py-2">Users</th>
                        <th class="py-2">Created At</th>
                        <th class="py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr class="border-b">
                        <td class="py-2 text-center">{{ $role->id }}</td>
                        <td class="py-2 text-center">{{ $role->name }}</td>
                        <td class="py-2 text-center">{{ $role->permissions->count() }}</td>
                        <td class="py-2 text-center">{{ $role->users->count() }}</td>
                        <td class="py-2 text-center">{{ $role->created_at->format('Y-m-d') }}</td>
                        <td class="py-2 text-center">
                            <a href="{{ route('roles.show', $role->id) }}" class="px-2 py-1 bg-green-500 text-white rounded">Show</a>
                            @if(Auth::user()->hasRole('admin'))
                            <a href="{{ route('roles.edit', $role->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded" onclick="return confirm('Are you sure you want to delete this role?');">Delete</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="flex justify-end mt-4">
                {{ $roles->links() }}
            </div>
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