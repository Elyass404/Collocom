<!-- resources/views/categories/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Details</title>
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
            <h1 class="text-2xl font-bold">Category Details</h1>
            <div class="flex gap-2">
                <a href="{{ route('categories.edit', $category->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                    Edit Category
                </a>
                <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    Back to Categories
                </a>
            </div>
        </div>

        <!-- Category Details Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Category Information</h3>
                    
                    <div class="border rounded-lg overflow-hidden">
                        <table class="w-full">
                            <tr class="border-b">
                                <td class="py-3 px-4 bg-gray-100 font-medium">ID</td>
                                <td class="py-3 px-4">{{ $category->id }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-3 px-4 bg-gray-100 font-medium">Name</td>
                                <td class="py-3 px-4">{{ $category->name }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-3 px-4 bg-gray-100 font-medium">Parent Category</td>
                                <td class="py-3 px-4">{{ $category->parent_id ? $category->parent->name : 'None' }}</td>
                            </tr>
            
                            <tr class="border-b">
                                <td class="py-3 px-4 bg-gray-100 font-medium">Created At</td>
                                <td class="py-3 px-4">{{ $category->created_at->format('F d, Y h:i A') }}</td>
                            </tr>
                            <tr>
                                <td class="py-3 px-4 bg-gray-100 font-medium">Updated At</td>
                                <td class="py-3 px-4">{{ $category->updated_at ? $category->updated_at->format('F d, Y h:i A'): "Not Updated" }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Description</h3>
                    <div class="border rounded-lg p-4 h-full">
                        {{ $category->description ?? 'No description available.' }}
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Related Items</h3>
                <div class="border rounded-lg p-4">
                    <p>Total Offers in this category: <span class="font-semibold">{{ $category->products_count ?? 0 }}</span></p>
                    <!-- Add more related information as needed -->
                </div>
            </div>

            <!-- Delete Button -->
            <div class="mt-6 flex justify-end">
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                        Delete Category
                    </button>
                </form>
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