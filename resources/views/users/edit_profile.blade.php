<!-- resources/views/profile/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    
    @include('components.headerUser')

    <!-- Main Content -->
    <div class="w-full pt-14 pb-12">
        
        @if (session('success'))
            <div class="container mx-auto  bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="container mx-auto  bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="container mx-auto  bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Page Header -->
        <div class="container mx-auto  mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Edit Profile</h1>
                    <p class="text-gray-600">Update your personal information and profile settings</p>
                </div>
                <a href="{{ route('users.profile', auth()->id()) }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Profile
                </a>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="container mx-auto ">
            <form action="{{ route('users.update',Auth::id()) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Left Column - Basic Info & Bio -->
                    <div class="md:col-span-2 space-y-6">
                        <!-- Basic Information Card -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">Basic Information</h2>
                            
                            <div class="space-y-5">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                
                                <div>
                                    <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $user->phone_number) }}" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                
                                <div>
                                    <label for="birthdate" class="block text-sm font-medium text-gray-700 mb-1">Birthdate</label>
                                    <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate', $user->birthdate) }}" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                                    <div class="flex gap-4 mt-1">
                                        <div class="flex items-center">
                                            <input type="radio" name="gender" id="male" value="Male" 
                                                {{ old('gender', $user->gender) == 'Male' ? 'checked' : '' }}
                                                class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                            <label for="male" class="ml-2 text-gray-700">Male</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" name="gender" id="female" value="Female" 
                                                {{ old('gender', $user->gender) == 'Female' ? 'checked' : '' }}
                                                class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                            <label for="female" class="ml-2 text-gray-700">Female</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="situation_id" class="block text-sm font-medium text-gray-700 mb-1">Situation</label>
                                    <select name="situation_id" id="situation_id" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Select a situation</option>
                                        @foreach($situations as $situation)
                                            <option value="{{ $situation->id }}" {{ old('situation_id', $user->situation_id) == $situation->id ? 'selected' : '' }}>
                                                {{ $situation->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Bio Card -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">About</h2>
                            
                            <div>
                                <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                                <textarea name="bio" id="bio" rows="6" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Tell others about yourself...">{{ old('bio', $user->bio) }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Write a short bio that describes you. This will be visible on your public profile.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column - Profile Picture & Security -->
                    <div class="space-y-6">
                        <!-- Profile Picture Card -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">Profile Picture</h2>
                            
                            <div class="flex flex-col items-center">
                                <div class="profile-preview mb-6">
                                    @if($user->profile_picture)
                                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" 
                                            class="w-32 h-32 rounded-full object-cover" id="profile-preview">
                                    @else
                                        <div class="w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center" id="profile-preview-placeholder">
                                            <span class="text-gray-500 text-4xl font-bold">{{ substr($user->name, 0, 1) }}</span>
                                        </div>
                                        <img src="" alt="{{ $user->name }}" class="w-32 h-32 rounded-full object-cover hidden" id="profile-preview">
                                    @endif
                                </div>
                                
                                <label for="profile_picture" class="cursor-pointer bg-blue-50 hover:bg-blue-100 text-blue-600 font-medium py-2 px-4 rounded-lg transition-colors flex items-center">
                                    <i class="fas fa-camera mr-2"></i> Choose Photo
                                    <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="hidden" onchange="previewImage()">
                                </label>
                                
                                @if($user->profile_picture)
                                    <div class="mt-2">
                                        <label for="remove_picture" class="flex items-center text-sm text-gray-600">
                                            <input type="checkbox" name="remove_picture" id="remove_picture" class="mr-2">
                                            Remove current picture
                                        </label>
                                    </div>
                                @endif
                                
                                <p class="text-xs text-gray-500 mt-3 text-center">Upload a square image for best results. Maximum size: 2MB.</p>
                            </div>
                        </div>
                        
                        <!-- Change Password Card -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">Security</h2>
                            
                            <div class="space-y-5">
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                    <input type="password" name="current_password" id="current_password" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                    <input type="password" name="password" id="password" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                
                                <p class="text-xs text-gray-500">Leave password fields blank if you don't want to change your password.</p>
                            </div>
                        </div>
                        
                        <!-- Save Button -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Function to preview the uploaded image
        function previewImage() {
            const input = document.getElementById('profile_picture');
            const preview = document.getElementById('profile-preview');
            const placeholder = document.getElementById('profile-preview-placeholder');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (placeholder) {
                        placeholder.classList.add('hidden');
                    }
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        // Handle "remove picture" checkbox
        document.addEventListener('DOMContentLoaded', function() {
            const removeCheckbox = document.getElementById('remove_picture');
            if (removeCheckbox) {
                removeCheckbox.addEventListener('change', function() {
                    const preview = document.getElementById('profile-preview');
                    const placeholder = document.getElementById('profile-preview-placeholder');
                    
                    if (this.checked) {
                        if (!placeholder) {
                            // Create placeholder if it doesn't exist
                            const placeholderDiv = document.createElement('div');
                            placeholderDiv.id = 'profile-preview-placeholder';
                            placeholderDiv.className = 'w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center';
                            placeholderDiv.innerHTML = '<span class="text-gray-500 text-2xl font-bold">{{ substr($user->name, 0, 1) }}</span>';
                            
                            preview.parentNode.insertBefore(placeholderDiv, preview);
                        } else {
                            placeholder.classList.remove('hidden');
                        }
                        
                        preview.classList.add('hidden');
                    } else {
                        if (placeholder) {
                            placeholder.classList.add('hidden');
                        }
                        preview.classList.remove('hidden');
                    }
                });
            }
        });
    </script>
</body>
</html>