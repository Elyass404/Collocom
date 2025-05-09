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
Copy<!-- Include Sidebar -->
@include('components.sidebar')

<!-- Main Content -->
<div class="ml-64 pt-32 p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Create New User</h1>

        <!-- Create User Form -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 mb-2">Name</label>
                <input type="text" name="name" id="name" 
                       class="w-full px-4 py-2 border rounded-lg @error('name') border-red-500 @enderror" 
                       value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 mb-2">Email</label>
                <input type="email" name="email" id="email" 
                       class="w-full px-4 py-2 border rounded-lg @error('email') border-red-500 @enderror" 
                       value="{{ old('email') }}" required>
                @error('email')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gender -->
            <div class="mb-4">
                <label for="gender" class="block text-gray-700 mb-2">Gender</label>
                <select name="gender" id="gender" 
                        class="w-full px-4 py-2 border rounded-lg @error('gender') border-red-500 @enderror">
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    
                </select>
                @error('gender')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role -->
            <div class="mb-4">
                <label for="role_id" class="block text-gray-700 mb-2">Role</label>
                <select name="role_id" id="role" class="w-full px-4 py-2 border rounded-lg @error('role') border-red-500 @enderror">
                    <option value="">Select Role</option>
                    <option value="1" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="editor" {{ old('role') == 'editor' ? 'selected' : '' }}>Editor</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 mb-2">Password</label>
                <input type="password" name="password" id="password" 
                       class="w-full px-4 py-2 border rounded-lg @error('password') border-red-500 @enderror" 
                       required>
                @error('password')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                       class="w-full px-4 py-2 border rounded-lg" 
                       required>
            </div>

            <!-- profile_picture -->
            <div class="mb-4">
                <label for="profile_picture" class="block text-gray-700 mb-2">Profile Photo</label>
                <input type="file" name="profile_picture" id="profile_picture" 
                       class="w-full px-4 py-2 border rounded-lg @error('photo') border-red-500 @enderror" 
                       accept="image/*">
                @error('photo')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Birthdate -->
            <div class="mb-4">
                <label for="birthdate" class="block text-gray-700 mb-2">Birthdate</label>
                <input type="date" name="birthdate" id="birthdate" 
                       class="w-full px-4 py-2 border rounded-lg @error('birthdate') border-red-500 @enderror" 
                       value="{{ old('birthdate') }}">
                @error('birthdate')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bio -->
            <div class="mb-4">
                <label for="bio" class="block text-gray-700 mb-2">Bio</label>
                <textarea name="bio" id="bio" rows="4" 
                          class="w-full px-4 py-2 border rounded-lg @error('bio') border-red-500 @enderror">{{ old('bio') }}</textarea>
                @error('bio')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Situation -->
            <div class="mb-4">
                <label for="situation_id" class="block text-gray-700 mb-2">Situation</label>
                <select name="situation_id" id="situation_id" 
                        class="w-full px-4 py-2 border rounded-lg @error('situation') border-red-500 @enderror">
                    <option value="">Select Situation</option>
                    <option value="1" {{ old('situation') == 'active' ? 'selected' : '' }}>Working</option>
                    <option value="inactive" {{ old('situation') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="pending" {{ old('situation') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
                @error('situation')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
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