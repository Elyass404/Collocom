<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - Your App Name</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center py-8 px-4">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl">
            <!-- Logo -->
            <div class="text-center mb-6">
                <div class="flex justify-center">
                    <img src="{{ asset('images/logos/collocom_full_logo_blue.svg') }}" class="h-12 w-auto" alt="Logo">
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mt-2">Create Account</h1>
            </div>

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <div class="flex flex-wrap -mx-3">
                    <!-- Left Column -->
                    <div class="w-full md:w-1/2 px-3">
                        <!-- Name Input -->
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-1">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter your full name">
                            @error('name')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email Input -->
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-1">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter your email">
                            @error('email')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Phone Number Input -->
                        <div class="mb-4">
                            <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-1">Phone Number</label>
                            <input type="tel" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter your phone number">
                            @error('phone_number')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-1">Password</label>
                            <input type="password" id="password" name="password" required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter your password">
                            @error('password')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-1">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Confirm your password">
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="w-full md:w-1/2 px-3">
                        <!-- Gender Selection -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-1">Gender</label>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center">
                                    <input type="radio" id="male" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}
                                        class="mr-1 focus:ring-blue-500">
                                    <label for="male" class="text-gray-700 text-sm">Male</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="female" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}
                                        class="mr-1 focus:ring-blue-500">
                                    <label for="female" class="text-gray-700 text-sm">Female</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="other" name="gender" value="other" {{ old('gender') == 'other' ? 'checked' : '' }}
                                        class="mr-1 focus:ring-blue-500">
                                    <label for="other" class="text-gray-700 text-sm">Other</label>
                                </div>
                            </div>
                            @error('gender')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Birthdate Input -->
                        <div class="mb-4">
                            <label for="birthdate" class="block text-gray-700 text-sm font-bold mb-1">Birthdate</label>
                            <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('birthdate')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Situation Select -->
                        <div class="mb-4">
                            <label for="situation" class="block text-gray-700 text-sm font-bold mb-1">Situation</label>
                            <select id="situation" name="situation" required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select your situation</option>
                                @foreach($situations as $situation)
                                    <option value="{{ $situation->id }}" {{ old('situation') == $situation->id ? 'selected' : '' }}>
                                        {{ $situation->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('situation')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Bio Textarea -->
                        <div class="mb-4">
                            <label for="bio" class="block text-gray-700 text-sm font-bold mb-1">Bio</label>
                            <textarea id="bio" name="bio" rows="2"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Tell us a bit about yourself">{{ old('bio') }}</textarea>
                            @error('bio')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Profile Picture Upload -->
                        <div class="mb-4">
                            <label for="profile_picture" class="block text-gray-700 text-sm font-bold mb-1">Profile Picture</label>
                            <div class="flex flex-col sm:flex-row items-center">
                                <div class="w-24 h-24 mb-3 sm:mb-0 sm:mr-4 overflow-hidden rounded-full bg-gray-200 flex items-center justify-center">
                                    <img id="preview-image" src="/api/placeholder/96/96" alt="Profile Preview" class="w-full h-full object-cover">
                                </div>
                                <label class="flex-1 flex flex-col items-center px-3 py-3 bg-white text-blue-500 rounded-lg shadow-sm tracking-wide border border-blue-500 cursor-pointer hover:bg-blue-500 hover:text-white text-sm">
                                    <svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                    </svg>
                                    <span class="mt-1 text-xs">Select Image</span>
                                    <input type="file" id="profile_picture" name="profile_picture" class="hidden" accept="image/*">
                                </label>
                            </div>
                            <div id="file-name" class="mt-1 text-xs text-center text-gray-600"></div>
                            @error('profile_picture')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="px-3 mb-3 mt-2">
                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Register
                    </button>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-gray-600 text-sm">Already have an account? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login here</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Display file name and preview image when selected
        document.getElementById('profile_picture').addEventListener('change', function() {
            const file = this.files[0];
            
            if (file) {
                // Display file name
                document.getElementById('file-name').textContent = file.name;
                
                // Show image preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                }
                reader.readAsDataURL(file);
            } else {
                document.getElementById('file-name').textContent = 'No file selected';
                document.getElementById('preview-image').src = '/api/placeholder/96/96';
            }
        });
    </script>
</body>
</html>