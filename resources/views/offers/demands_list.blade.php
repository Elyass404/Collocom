<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Demand Requests - My Offer</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Include Header Component -->
    @include('components.headerUser')

    <main class="container mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Demand Requests</h1>
                <p class="text-gray-600 mt-1">Manage people interested in your property</p>
            </div>
            <a href="{{ route('my_offer') }}" class="mt-4 md:mt-0 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-all duration-300 ease-in-out">
                <i class="fas fa-arrow-left mr-2"></i>Back to my Offer
            </a>
        </div>

        <!-- Success and Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z"/>
                </svg>
            </span>
            </div>
        @endif

        <!-- Main Content -->

        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Left Side - Demand Tabs -->
            <div class="lg:w-3/4">
                <!-- Tabs -->
                <div class="bg-white rounded-lg shadow-md mb-6">
                    <nav class="flex border-b">
                        <button id="tab-pending" class="tab-btn py-4 px-6 text-center border-b-2 border-blue-500 font-medium text-blue-500 flex-1 focus:outline-none">
                            <span class="mr-2">Pending</span>
                            <span class="bg-blue-100 text-blue-500 px-2 py-1 rounded-full text-xs">{{ $pendingDemands }}</span>
                        </button>
                        <button id="tab-accepted" class="tab-btn py-4 px-6 text-center border-b-2 border-transparent font-medium text-gray-500 hover:text-gray-700 flex-1 focus:outline-none">
                            <span class="mr-2">Accepted</span>
                            <span class="bg-green-100 text-green-500 px-2 py-1 rounded-full text-xs">{{ $acceptedDemands }}</span>
                        </button>
                        <button id="tab-rejected" class="tab-btn py-4 px-6 text-center border-b-2 border-transparent font-medium text-gray-500 hover:text-gray-700 flex-1 focus:outline-none">
                            <span class="mr-2">Rejected</span>
                            <span class="bg-red-100 text-red-500 px-2 py-1 rounded-full text-xs">{{ $rejectedDemands }}</span>
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div id="tab-content-pending" class="tab-content">
                    @if($pendingDemands > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($pendingDemandsList as $demand)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-1 transition-transform duration-300">
                                <div class="p-5">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center">
                                            <img src="{{ asset('storage/'.$demand->user->profile_picture) }}" alt="{{ $demand->user->name }}" class="h-12 w-12 rounded-full object-cover border-2 border-blue-100">
                                            <div class="ml-4">
                                                <h3 class="font-medium text-gray-800">{{ $demand->user->name }}</h3>
                                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ 
                                                    $demand->user->situation == 'Student' ? 'bg-blue-100 text-blue-800' : 
                                                    ($demand->user->situation == 'Employee' ? 'bg-green-100 text-green-800' : 
                                                    'bg-purple-100 text-purple-800') 
                                                }}">
                                                    {{ $demand->user->situation ? $demand->user->situation->name : 'N/A' }}
                                                </span>
                                            </div>
                                        </div>
                                        <span class="text-xs text-gray-500">{{ $demand->created_at->format('M d, Y') }}</span>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <p class="text-sm text-gray-600">{{ Str::limit($demand->user->bio, 110) }}</p>
                                    </div>
                                    
                                    <div class="mt-4 flex items-center">
                                        <i class="fas fa-phone-alt text-gray-400 mr-2"></i>
                                        <span class="text-sm text-gray-600">{{ $demand->user->phone_number }}</span>
                                    </div>
                                    
                                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                                        <a href="{{ route('users.profile', $demand->user->id) }}" class="text-blue-500 hover:text-blue-700 text-sm font-medium flex items-center">
                                            <i class="fas fa-user-circle mr-1"></i>
                                            View Profile
                                        </a>
                                        <div class="flex gap-2">
                                            <form action="{{ route('offers.rejectDemand', $demand->id) }}" method="GET">
                                                @csrf
                                                <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-600 px-4 py-2 rounded-md text-sm font-medium transition-colors duration-300">
                                                    Reject
                                                </button>
                                            </form>
                                            <form action="{{ route('offers.acceptDemand', $demand->id) }}" method="GET">
                                                @csrf
                                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-300">
                                                    Accept
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white rounded-lg shadow-md p-8 text-center">
                            <div class="mx-auto h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-inbox text-blue-500 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-800">No pending demands</h3>
                            <p class="text-gray-500 mt-1">There are currently no pending demand requests for your property.</p>
                        </div>
                    @endif
                </div>
                
                <div id="tab-content-accepted" class="tab-content hidden">
                    @if($acceptedDemands > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($acceptedDemandsList as $demand)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-1 transition-transform duration-300">
                                <div class="p-5">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center">
                                            <img src="{{ asset('storage/'.$demand->user->profile_picture) }}" alt="{{ $demand->user->name }}" class="h-12 w-12 rounded-full object-cover border-2 border-green-100">
                                            <div class="ml-4">
                                                <h3 class="font-medium text-gray-800">{{ $demand->user->name }}</h3>
                                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ 
                                                    $demand->user->situation == 'Student' ? 'bg-blue-100 text-blue-800' : 
                                                    ($demand->user->situation == 'Employee' ? 'bg-green-100 text-green-800' : 
                                                    'bg-purple-100 text-purple-800') 
                                                }}">
                                                    {{ $demand->user->situation ? $demand->user->situation->name : 'N/A' }}
                                                </span>
                                            </div>
                                        </div>
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">Accepted</span>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <p class="text-sm text-gray-600">{{ Str::limit($demand->user->bio, 110) }}</p>
                                    </div>
                                    
                                    <div class="mt-4 flex items-center">
                                        <i class="fas fa-phone-alt text-gray-400 mr-2"></i>
                                        <span class="text-sm text-gray-600">{{ $demand->user->phone_number }}</span>
                                    </div>
                                    
                                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                                        <a href="{{ route('users.profile', $demand->user->id) }}" class="text-blue-500 hover:text-blue-700 text-sm font-medium flex items-center">
                                            <i class="fas fa-user-circle mr-1"></i>
                                            View Profile
                                        </a>
                                        <div>
                                            <span class="text-xs text-gray-500">Accepted on {{ $demand->updated_at->format('M d, Y') }}</span>
                                        </div>
                                        <div class="flex gap-2">
                                            <form action="{{ route('offers.rejectDemand', $demand->id) }}" method="GET">
                                                @csrf
                                                <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-600 px-4 py-2 rounded-md text-sm font-medium transition-colors duration-300">
                                                    Reject
                                                </button>
                                            </form>
                                            <form action="{{ route('offers.pendingDemand', $demand->id) }}" method="GET">
                                                @csrf
                                                <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-300">
                                                    Pending
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white rounded-lg shadow-md p-8 text-center">
                            <div class="mx-auto h-16 w-16 bg-green-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-check text-green-500 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-800">No accepted demands</h3>
                            <p class="text-gray-500 mt-1">You haven't accepted any demand requests yet.</p>
                        </div>
                    @endif
                </div>
                
                <div id="tab-content-rejected" class="tab-content hidden">
                    @if($rejectedDemands > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($rejectedDemandsList as $demand)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-1 transition-transform duration-300">
                                <div class="p-5">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center">
                                            <img src="{{asset('storage/'.$demand->user->profile_picture)  }}" alt="{{ $demand->user->name }}" class="h-12 w-12 rounded-full object-cover border-2 border-red-100">
                                            <div class="ml-4">
                                                <h3 class="font-medium text-gray-800">{{ $demand->user->name }}</h3>
                                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ 
                                                    $demand->user->situation == 'Student' ? 'bg-blue-100 text-blue-800' : 
                                                    ($demand->user->situation == 'Employee' ? 'bg-green-100 text-green-800' : 
                                                    'bg-purple-100 text-purple-800') 
                                                }}">
                                                    {{ $demand->user->situation ? $demand->user->situation->name : 'N/A' }}
                                                </span>
                                            </div>
                                        </div>
                                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">Rejected</span>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <p class="text-sm text-gray-600">{{ Str::limit($demand->user->bio, 110) }}</p>
                                    </div>
                                    
                                    <div class="mt-4 flex items-center">
                                        <i class="fas fa-phone-alt text-gray-400 mr-2"></i>
                                        <span class="text-sm text-gray-600">{{ $demand->user->phone_number }}</span>
                                    </div>
                                    
                                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                                        <a href="{{ route('users.show', $demand->user->id) }}" class="text-blue-500 hover:text-blue-700 text-sm font-medium flex items-center">
                                            <i class="fas fa-user-circle mr-1"></i>
                                            View Profile
                                        </a>
                                        <div>
                                            <span class="text-xs text-gray-500">Rejected on {{ $demand->updated_at->format('M d, Y') }}</span>
                                        </div>
                                        <div class="flex gap-2">
                                            <form action="{{ route('offers.pendingDemand', $demand->id) }}" method="GET">
                                                @csrf
                                                <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-300">
                                                    Pending
                                                </button>
                                            </form>
                                            <form action="{{ route('offers.acceptDemand', $demand->id) }}" method="GET">
                                                @csrf
                                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-300">
                                                    Accept
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white rounded-lg shadow-md p-8 text-center">
                            <div class="mx-auto h-16 w-16 bg-red-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-times text-red-500 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-800">No rejected demands</h3>
                            <p class="text-gray-500 mt-1">You haven't rejected any demand requests yet.</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Right Side - Accepted Users List -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-5">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-bold text-gray-800">My Actual Roommates</h2>
                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">{{ $acceptedDemands }}</span>
                    </div>
                    
                    @if($acceptedDemands > 0)
                        <div class="space-y-4">
                            @foreach($acceptedDemandsList as $demand)
                            <div class="bg-gray-50 rounded-lg p-4 transform hover:-translate-y-1 transition-transform duration-300">
                                <div class="flex items-center">
                                    <img src="{{ asset('storage/'.$demand->user->profile_picture) }}" alt="{{ $demand->user->name }}" class="h-10 w-10 rounded-full object-cover border-2 border-green-100">
                                    <div class="ml-3">
                                        <h3 class="font-medium text-gray-800">{{ $demand->user->name }}</h3>
                                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ 
                                            $demand->user->situation == 'Student' ? 'bg-blue-100 text-blue-800' : 
                                            ($demand->user->situation == 'Employee' ? 'bg-green-100 text-green-800' : 
                                            'bg-purple-100 text-purple-800') 
                                        }} mt-1">
                                                     {{ $demand->user->situation ? $demand->user->situation->name : 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="mt-3 flex items-center">
                                    <i class="fas fa-phone-alt text-gray-400 mr-2"></i>
                                    <span class="text-sm text-gray-600">{{ $demand->user->phone_number }}</span>
                                </div>
                                
                                <div class="mt-3">
                                    <a href="{{ route('users.profile', $demand->user->id) }}" class="text-blue-500 hover:text-blue-700 text-sm font-medium flex items-center justify-center w-full bg-blue-50 hover:bg-blue-100 py-2 rounded-md transition-colors duration-300">
                                        <i class="fas fa-user-circle mr-1"></i>
                                        Show Profile
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6 bg-gray-50 rounded-lg">
                            <div class="mx-auto h-12 w-12 bg-green-100 rounded-full flex items-center justify-center mb-3">
                                <i class="fas fa-home text-green-500"></i>
                            </div>
                            <h3 class="text-md font-medium text-gray-800">No roommates yet</h3>
                            <p class="text-sm text-gray-500 mt-1">Accept demand requests to add future roommates</p>
                        </div>
                    @endif
                    
                    <div class="mt-6">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h3 class="font-medium text-blue-800 mb-2 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                Need help?
                            </h3>
                            <p class="text-sm text-blue-700">
                                Having trouble deciding on roommates? Call our support team for advice.
                            </p>
                            <a href="tel:+123456789" class="text-blue-600 hover:text-blue-800 text-sm font-medium mt-2 flex items-center">
                                <i class="fas fa-phone-alt mr-1"></i>
                                Contact Support
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Include Footer Component -->
    @include('components.footer')

    <script>
        // Tab functionality
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons and hide all contents
                tabButtons.forEach(btn => {
                    btn.classList.remove('border-blue-500', 'text-blue-500');
                    btn.classList.add('border-transparent', 'text-gray-500');
                });
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                });
                
                // Add active class to clicked button and show corresponding content
                button.classList.remove('border-transparent', 'text-gray-500');
                button.classList.add('border-blue-500', 'text-blue-500');
                
                const tabId = button.id.replace('tab-', '');
                document.getElementById(`tab-content-${tabId}`).classList.remove('hidden');
            });
        });
    </script>
</body>
</html>