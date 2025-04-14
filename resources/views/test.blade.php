<!-- resources/views/categories/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    
    @include('components.topbar')

    @include('components.sidebar')

    <!-- Main Content -->
    <div class="ml-64 pt-32 p-6">
        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500">Total Categories</h3>
                <p class="text-2xl font-bold">2</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500">Active Categories</h3>
                <p class="text-2xl font-bold">2</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500">Latest Category</h3>
                <p class="text-2xl font-bold">2</p>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Categories</h2>
                <div class="flex gap-4">
                    <input type="text" placeholder="Search..." class="px-4 py-2 border rounded-lg">
                    <a href="#" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Create New Category
                    </a>
                </div>
            </div>
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 ">ID</th>
                        <th class="py-2">Name</th>
                        <th class="py-2">Created At</th>
                        <th class="py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach($categories as $category)
                    <tr class="border-b">
                        <td class="py-2">{{ $category->id }}</td>
                        <td class="py-2">{{ $category->name }}</td>
                        <td class="py-2">{{ $category->created_at->format('Y-m-d') }}</td>
                        <td class="py-2">
                            <a href="{{ route('categories.show', $category->id) }}" class="px-2 py-1 bg-green-500 text-white rounded">Show</a>
                            <a href="{{ route('categories.edit', $category->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach --}}
                    <tr class="border-b">
                        <td class="py-2 text-center bg-yellow-500">hhhhhh</td>
                        <td class="py-2 text-ce text-center bg-red-700">hhfffffffffffffffffffffffffffffffffhhhhhh</td>
                        <td class="py-2 text-center bg-orange-600">hhhhh</td>
                        <td class="py-2 text-center bg-blue-700">
                            <a href="#" class="px-2 py-1 bg-green-500 text-white rounded">Show</a>
                            <a href="#" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                            <form action="#" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="flex justify-end mt-4">
                {{-- {{ $categories->links() }} --}}
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