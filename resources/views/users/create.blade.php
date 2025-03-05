<!-- resources/views/users/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New User</title>
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
            <h1 class="text-2xl font-bold mb-6">Create New User</h1>

            <!-- Create User Form -->
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <!-- Photo -->
                <div class="mb-4">
                    <label for="photo" class="block text-gray-700">Photo</label>
                    <input type="file" name="photo" id="photo" class="w-full px-4 py-2 border rounded-lg">
                </div>

                <!-- Address -->
                <div class="mb-4">
                    <label for="address" class="block text-gray-700">Address</label>
                    <input type="text" name="address" id="address" class="w-full px-4 py-2 border rounded-lg">
                </div>

                <!-- Bio -->
                <div class="mb-4">
                    <label for="bio" class="block text-gray-700">Bio</label>
                    <textarea name="bio" id="bio" rows="4" class="w-full px-4 py-2 border rounded-lg"></textarea>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Create User
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