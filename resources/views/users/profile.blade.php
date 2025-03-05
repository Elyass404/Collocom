<!-- resources/views/users/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Include Top Bar -->
    @include('components.topbar')

    <!-- Main Content -->
    <div class="pt-32 p-6">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="#" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">Update Profile</h1>

            <!-- Update Profile Form -->
            <form action="{{--{{ route('profile.update') }}--}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="{{--{{ old('name', $user->name) }}--}}" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{--{{ old('email', $user->email) }}--}}" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <!-- Photo -->
                <div class="mb-4">
                    <label for="photo" class="block text-gray-700">Profile Photo</label>
                    <input type="file" name="photo" id="photo" class="w-full px-4 py-2 border rounded-lg">
                    {{--@if($user->photo)
                        <div class="mt-2">
                            <img src="https://images.unsplash.com/profile-1700009111141-05e9502e95c4image?w=150&dpr=1&crop=faces&bg=%23fff&h=150&auto=format&fit=crop&q=60&ixlib=rb-4.0.3" alt="Current Profile Photo" class="h-20 w-20 rounded-full object-cover">
                        </div>
                    @endif--}}
                </div>

                <!-- Address -->
                <div class="mb-4">
                    <label for="address" class="block text-gray-700">Address</label>
                    <input type="text" name="address" id="address" value="{{--{{ old('address', $user->address) }}--}}" class="w-full px-4 py-2 border rounded-lg">
                </div>

                <!-- Bio -->
                <div class="mb-4">
                    <label for="bio" class="block text-gray-700">Bio</label>
                    <textarea name="bio" id="bio" rows="4" class="w-full px-4 py-2 border rounded-lg">{{--{{ old('bio', $user->bio) }}--}}</textarea>
                </div>

                <!-- Password (Optional Update) -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">New Password (Optional)</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-lg">
                    <p class="text-sm text-gray-600 mt-1">Leave blank if you don't want to change your password</p>
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2 border rounded-lg">
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Update Profile
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