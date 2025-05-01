<!-- resources/views/profile/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Profile</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    
    @include('components.headerUser')

    <!-- Main Content -->
    <div class="w-full pt-10 pb-12">
        
        @if (session('success'))
            <div class="mx-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Profile Header Section -->
        <div class="relative bg-gradient-to-r from-red-500 to-blue-600 h-64">
            <!-- Edit Profile Button - Only visible to the profile owner -->
            @if(auth()->id() == $user->id)
                <a href="#{{--{{ route('profile.edit') }}--}}" class="absolute top-4 right-6 bg-white bg-opacity-20 hover:bg-opacity-30 p-3 rounded-full text-white transition duration-200">
                    <i class="fas fa-cog text-xl"></i>
                      
                </a>
            @endif
            
            <!-- Profile Image and Basic Info -->
            <div class="container mx-auto px-6">
                <div class="flex items-center pt-32">
                    <div class="relative">
                        @if($user->profile_picture)
                            <img src="{{--{{ asset('storage/' . $user->profile_picture) }}--}}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full border-4 border-white object-cover">
                        @else
                            <div class="w-32 h-32 rounded-full border-4 border-white bg-gray-300 flex items-center justify-center">
                                <span class="text-gray-500 text-2xl font-bold">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="ml-6 pt-10">
                        <h1 class="text-3xl font-bold text-white">{{ $user->name }}</h1>
                        <p class="text-blue-100 mt-1">{{ $user->email }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Profile Content -->
        <div class="container mx-auto px-6 py-4  mt-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
                <!-- Left Column - Bio and Basic Info -->
                <div class="md:col-span-2 space-y-6 ">
                    <!-- Bio Card -->
                    <div class="bg-white rounded-lg  shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">About</h2>
                        @if($user->bio)
                            <p class="text-gray-700 whitespace-pre-line">{{ $user->bio }}</p>
                        @else
                            <p class="text-gray-500 italic">No bio available</p>
                        @endif
                    </div>
                    
                    
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Activity</h2>
                        <!-- Placeholder for future activity content -->
                        <div class="text-center py-10 text-gray-500">
                            <i class="fas fa-chart-line text-4xl mb-3"></i>
                            <p>User activity will be shown here</p>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column - User Details -->
                <div class="space-y-6 ">
                    <!-- Personal Info Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Personal Information</h2>
                        
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-10 text-center text-gray-500">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Phone Number</p>
                                    <p class="text-gray-800">{{ $user->phone_number ?? 'Not provided' }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="w-10 text-center text-gray-500">
                                    <i class="fas fa-venus-mars"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Gender</p>
                                    <p class="text-gray-800">{{ $user->gender ?? 'Not specified' }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="w-10 text-center text-gray-500">
                                    <i class="fas fa-birthday-cake"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Birthdate</p>
                                    <p class="text-gray-800">
                                        @if($user->birthdate)
                                            {{ \Carbon\Carbon::parse($user->birthdate)->format('F j, Y') }}
                                        @else
                                            Not provided
                                        @endif
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="w-10 text-center text-gray-500">
                                    <i class="fas fa-user-tag"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Situation</p>
                                    <p class="text-gray-800">{{ $user->situation->name ?? 'Not specified' }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="w-10 text-center text-gray-500">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Member Since</p>
                                    <p class="text-gray-800">{{ $user->created_at->format('F Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Connect Card - For future social features -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Connect</h2>
                        
                        <!-- This is a placeholder for future social connection features -->
                        <div class="flex items-center justify-center space-x-4 py-2">
                            <button class="bg-blue-100 text-blue-500 p-3 rounded-full hover:bg-blue-200 transition">
                                <i class="fab fa-facebook-f"></i>
                            </button>
                            <button class="bg-blue-100 text-blue-500 p-3 rounded-full hover:bg-blue-200 transition">
                                <i class="fab fa-twitter"></i>
                            </button>
                            <button class="bg-blue-100 text-blue-500 p-3 rounded-full hover:bg-blue-200 transition">
                                <i class="fab fa-linkedin-in"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Any JavaScript needed for profile page interactions
    </script>
</body>
</html>