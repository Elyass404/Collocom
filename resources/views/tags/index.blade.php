<!-- resources/views/tags/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tags</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Include Top Bar -->
    @include('components.topbar')

    <!-- Include Sidebar -->
    @include('components.sidebar')

    <!-- Main Content -->
    <div class="ml-64 pt-32 p-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <!-- Table Header with Search Bar and Create Tag Button -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Tags</h2>
                <div class="flex items-center space-x-4">
                    <!-- Search Bar -->
                    <input type="text" placeholder="Search..." class="px-4 py-2 border rounded-lg">
                    <!-- Create Tag Button -->
                    <a href="{{ route('tags.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Create Tag
                    </a>
                </div>
            </div>

            <!-- Tags Table -->
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="py-2">ID</th>
                        <th class="py-2">Name</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($tags as $tag)
                        <tr class="border-b">
                            <td class="py-2">{{ $tag->id }}</td>
                            <td class="py-2">{{ $tag->name }}</td>
                        </tr>
                    @endforeach --}}
                    <td class="py-2">1</td>
                            <td class="py-2">hello tag</td>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="flex justify-end mt-4">
                {{-- {{ $tags->links() }} --}}
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