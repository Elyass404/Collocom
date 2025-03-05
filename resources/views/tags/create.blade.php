<!-- resources/views/tags/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Tag</title>
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
            <h1 class="text-2xl font-bold mb-6">Create New Tag</h1>

            <!-- Create Tag Form -->
            <form action="#" method="POST">
                @csrf
                <!-- Name Input -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Tag Name</label>
                    <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-lg" placeholder="Enter tag name" required>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Create Tag
                    </button>
                </div>
            </form>
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