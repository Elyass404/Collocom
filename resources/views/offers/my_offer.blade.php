<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Offer - Dashboard</title>
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
                <h1 class="text-3xl font-bold text-gray-800">My Offer Dashboard</h1>
                <p class="text-gray-600 mt-1">Manage your property listing and track demand requests</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('offers.edit', $offer->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-all duration-300 ease-in-out mr-2">
                    <i class="fas fa-edit mr-2"></i>Edit Offer
                </a>
                <button id="toggleOfferStatus" class="{{ $offer->is_active ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }} text-white px-4 py-2 rounded-md transition-all duration-300 ease-in-out">
                    <i class="fas {{ $offer->is_active ? 'fa-pause' : 'fa-play' }} mr-2"></i>{{ $offer->is_active ? 'Pause Offer' : 'Activate Offer' }}
                </button>
            </div>
        </div>

        <!-- Offer Status Banner -->
        @if(!$offer->is_active)
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded-md" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="ml-3">
                    <p class="font-medium">Your offer is currently paused</p>
                    <p class="text-sm">Your property is not visible to potential roommates. Activate it to receive new demand requests.</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Property Overview Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <div class="md:flex">
                <div class="md:w-1/3">
                    <img src="{{ asset("storage/".$offer->thumbnail) }}" alt="Property Image" class="h-64 w-full object-cover">
                </div>
                <div class="p-6 md:w-2/3">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">{{ $offer->title }}</h2>
                            <p class="text-gray-600 flex items-center mt-1">
                                <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>
                                {{ $offer->title }}
                            </p>
                        </div>
                        <span class="bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full font-semibold uppercase">{{ $offer->category->name }}</span>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                        <div class="text-center">
                            <p class="text-gray-600 text-sm">Monthly Rent</p>
                            <p class="font-bold text-gray-800">${{ $offer->price }}/mo</p>
                        </div>
                        <div class="text-center">
                            <p class="text-gray-600 text-sm">Room Type</p>
                            <p class="font-bold text-gray-800">{{ $offer->category->name }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-gray-600 text-sm">Available From</p>
                            <p class="font-bold text-gray-800">{{ $offer->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-gray-600 text-sm">Published On</p>
                            <p class="font-bold text-gray-800">{{ $offer->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-2 mt-4">
                        @foreach(["TV","Pool","Back yard","Duplex","Limmak",] as $amenity)
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">{{ $amenity }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Demands Card -->
            <div class="bg-white rounded-lg shadow-md p-6 transform hover:-translate-y-1 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Demands</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalDemands }}</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-full">
                        <i class="fas fa-users text-blue-500"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center">
                        <span class="text-sm font-medium text-gray-500">Conversion rate:</span>
                        <span class="ml-2 text-sm font-medium text-green-600">{{ round(($acceptedDemands / ($totalDemands ?: 1)) * 100) }}%</span>
                    </div>
                </div>
            </div>

            <!-- Last 24h Demands Card -->
            <div class="bg-white rounded-lg shadow-md p-6 transform hover:-translate-y-1 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Last 24h Demands</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $recentDemands }}</p>
                    </div>
                    <div class="p-3 bg-purple-100 rounded-full">
                        <i class="fas fa-bolt text-purple-500"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center">
                        @if(1)
                        <span class="text-green-500 flex items-center">
                            <i class="fas fa-arrow-up mr-1"></i> 45%
                        </span>
                        <span class="ml-2 text-sm text-gray-500">from previous day</span>
                        @elseif($demandTrend < 0)
                        <span class="text-red-500 flex items-center">
                            <i class="fas fa-arrow-down mr-1"></i> {{ abs(12) }}%
                        </span>
                        <span class="ml-2 text-sm text-gray-500">from previous day</span>
                        @else
                        <span class="text-gray-500 flex items-center">
                            <i class="fas fa-minus mr-1"></i> 0%
                        </span>
                        <span class="ml-2 text-sm text-gray-500">no change</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Accepted Demands Card -->
            <div class="bg-white rounded-lg shadow-md p-6 transform hover:-translate-y-1 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Accepted Demands</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $acceptedDemands }}</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-full">
                        <i class="fas fa-check text-green-500"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center">
                        <span class="text-sm font-medium text-gray-500">Acceptance rate:</span>
                        <span class="ml-2 text-sm font-medium text-green-600">{{ round(($acceptedDemands / ($totalDemands ?: 1)) * 100) }}%</span>
                    </div>
                </div>
            </div>

            <!-- Rejected Demands Card -->
            <div class="bg-white rounded-lg shadow-md p-6 transform hover:-translate-y-1 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Rejected Demands</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $rejectedDemands }}</p>
                    </div>
                    <div class="p-3 bg-red-100 rounded-full">
                        <i class="fas fa-times text-red-500"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center">
                        <span class="text-sm font-medium text-gray-500">Rejection rate:</span>
                        <span class="ml-2 text-sm font-medium text-red-600">{{ round(($rejectedDemands / ($totalDemands ?: 1)) * 100) }}%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Demands Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Recent Demand Requests</h2>
                <a href="#{{-- {{ route('demands.index') }} --}}" class="text-blue-500 hover:text-blue-700 flex items-center transition-colors duration-300">
                    Show all demands
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            @if($recentDemands> 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($recentDemandsList as $demand)
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100 transform hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center">
                            <img src="{{ asset('storage/'.$demand->owner->name) }}" alt="{{ $demand->owner->name }}" class="h-10 w-10 rounded-full object-cover">
                            <div class="ml-3">
                                <h3 class="font-medium text-gray-800">{{ $demand->user->name }}</h3>
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ 
                                    $demand->user->situation == 'Student' ? 'bg-blue-100 text-blue-800' : 
                                    ($demand->user->situation == 'Employee' ? 'bg-green-100 text-green-800' : 
                                    'bg-purple-100 text-purple-800') 
                                }}">
                                    {{ $demand->user->situation }}
                                </span>
                            </div>
                        </div>
                        <span class="text-xs text-gray-500">{{ $demand->created_at->diffForHumans() }}</span>
                    </div>
                    
                    <div class="mt-3">
                        <p class="text-sm text-gray-600 line-clamp-2">{{ Str::limit($demand->user->bio, 80) }}</p>
                    </div>
                    
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-xs font-medium px-2 py-1 rounded-full {{ 
                            $demand->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                            ($demand->status == 'accepted' ? 'bg-green-100 text-green-800' : 
                            'bg-red-100 text-red-800') 
                        }}">
                            {{ ucfirst($demand->status) }}
                        </span>
                        <a href="{{ route('demands.show', $demand->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Show User
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <div class="mx-auto h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-inbox text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-800">No demands received yet</h3>
                <p class="text-gray-500 mt-1">When someone shows interest in your property, their request will appear here.</p>
            </div>
            @endif
        </div>

        <!-- Verification Status -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Verification Status</h2>
            
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center mb-4 md:mb-0">
                    @if($offer->is_verified)
                    <div class="bg-green-100 p-3 rounded-full mr-4">
                        <i class="fas fa-check-circle text-green-500 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800">Your offer is verified</h3>
                        <p class="text-sm text-gray-600">Verified offers receive 3x more demand requests on average</p>
                    </div>
                    @else
                    <div class="bg-yellow-100 p-3 rounded-full mr-4">
                        <i class="fas fa-exclamation-circle text-yellow-500 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800">Your offer is pending verification</h3>
                        <p class="text-sm text-gray-600">Our team will review your listing within 24-48 hours</p>
                    </div>
                    @endif
                </div>
                
                @if(!$offer->is_verified)
                <a href="{{ route('verification.documents') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-colors duration-300 ease-in-out">
                    <i class="fas fa-upload mr-2"></i>Upload Documents
                </a>
                @endif
            </div>
        </div>

        <!-- Insights Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Insights</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Most Common Occupations -->
                <div>
                    <h3 class="font-medium text-gray-700 mb-3">Most Common Situations</h3>
                    <div class="space-y-3">
                        @foreach($situationStats as $situation)
                        <div class="flex items-center">
                            <span class="text-sm text-gray-600 w-24">{{ $situation['name'] }}</span>
                            <div class="flex-1 mx-2">
                                <div class="bg-gray-200 rounded-full h-2 overflow-hidden">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $situation['percentage'] }}%"></div>
                                </div>
                            </div>
                            <span class="text-sm font-medium text-gray-700">{{ $situation['percentage'] }}%</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Average Response Time -->
                <div>
                    <h3 class="font-medium text-gray-700 mb-3">Your Response Performance</h3>
                    <div class="flex items-center mb-4">
                        <div class="p-3 bg-{{ $avgResponseTime < 24 ? 'green' : ($avgResponseTime < 48 ? 'yellow' : 'red') }}-100 rounded-full mr-4">
                            <i class="fas fa-clock text-{{ $avgResponseTime < 24 ? 'green' : ($avgResponseTime < 48 ? 'yellow' : 'red') }}-500"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Average response time</p>
                            <p class="font-medium text-gray-800">
                                @if($avgResponseTime < 1)
                                    Less than 1 hour
                                @elseif($avgResponseTime < 24)
                                    {{ round($avgResponseTime) }} hours
                                @else
                                    {{ round($avgResponseTime / 24, 1) }} days
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="p-3 bg-{{ $responseRate >= 80 ? 'green' : ($responseRate >= 60 ? 'yellow' : 'red') }}-100 rounded-full mr-4">
                            <i class="fas fa-reply text-{{ $responseRate >= 80 ? 'green' : ($responseRate >= 60 ? 'yellow' : 'red') }}-500"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Response rate</p>
                            <p class="font-medium text-gray-800">{{ $responseRate }}%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Include Footer Component -->
    @include('components.footer')

    <script>
        document.getElementById('toggleOfferStatus').addEventListener('click', function() {
            // Send AJAX request to toggle status
            fetch('{{ route("offer.toggle", $offer->id) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            });
        });
    </script>
</body>
</html>