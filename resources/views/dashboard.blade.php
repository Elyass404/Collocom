<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    
    @include('components.topbar')

    @include('components.sidebar')

    <!-- Main Content -->
    <div class="ml-64 pt-32 p-6">
        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500">Total Users</h3>
                <p class="text-2xl font-bold">{{$countUsers}}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500">Total Tags</h3>
                <p class="text-2xl font-bold">50</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500">Total Offers</h3>
                <p class="text-2xl font-bold">427</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500">Revenue</h3>
                <p class="text-2xl font-bold">MAD 12,345</p>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Users</h2>
                <input type="text" placeholder="Search..." class="px-4 py-2 border rounded-lg">
                <a href="{{ route('users.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    Create New User
                </a>
            </div>
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="py-2">ID</th>
                        <th class="py-2">Name</th>
                        <th class="py-2">Email</th>
                        <th class="py-2">Role</th>
                        <th class="py-2">Actions</th>
                    </tr>
                </thead>
                <tbody class="">
                    {{-- <td class="py-2">1</td>
                        <td class="py-2">Mustapha</td>
                        <td class="py-2">Mustapha@youcode.com</td>
                        <td class="py-2">User </td>
                        <td class="py-2">
                            <a href="#" class="px-2 py-1 bg-green-500 text-white rounded">Show</a>
                            <a href="#" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                            <form action="#" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
                            </form>
                        </td> --}}
                    @foreach($users as $user)
                    <tr class="border-b">
                        <td class="py-2">{{ $user->id }}</td>
                        <td class="py-2">{{ $user->name }}</td>
                        <td class="py-2">{{ $user->email }}</td>
                        <td class="py-2">{{ $user->role_id }}</td>
                        <td class="py-2">
                            <a href="{{ route('users.show', $user->id) }}" class="px-2 py-1 bg-green-500 text-white rounded">Show</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="flex justify-end mt-4">
                {{-- {{ $users->links() }} --}}
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
