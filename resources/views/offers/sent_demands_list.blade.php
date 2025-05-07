<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Demands</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    @include('components.headerUser')
    
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8 flex justify-between items-center">
            <h2 class="text-2xl font-bold">My Demands</h2>
            @if($pendingDemandsList->isNotEmpty())
                <form action="#{{-- {{ route('demands.cancel-all') }}--}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md transition">
                        Cancel All Demands
                    </button>
                </form>
            @endif
        </div>

        <!-- Status Tabs -->
        <div class="mb-6 border-b border-gray-200">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                <li class="mr-2">
                    <a href="#pending" class="inline-block p-4 rounded-t-lg border-b-2 border-indigo-600 text-indigo-600 active">
                        Pending ({{ $pendingDemands }})
                    </a>
                </li>
                <li class="mr-2">
                    <a href="#accepted" class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:border-gray-300">
                        Accepted ({{ $acceptedDemands }})
                    </a>
                </li>
                <li class="mr-2">
                    <a href="#rejected" class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:border-gray-300">
                        Rejected ({{ $rejectedDemands }})
                    </a>
                </li>
            </ul>
        </div>

        <!-- Pending Demands Section -->
        <div id="pending" class="mb-10">
            <h3 class="text-xl font-semibold mb-4">Pending Demands</h3>
            
            @if($pendingDemands == 0 )
                <div class="bg-gray-100 rounded-lg p-6 text-center">
                    <p class="text-gray-500">You don't have any pending demands.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($pendingDemandsList as $demand)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition">
                            <!-- Card Image -->
                            <div class="relative h-48">
                                <img src="{{ asset('storage/'.$demand->offer->thumbnail) }}" alt="Offer Thumbnail" class="w-full h-full object-cover">
                                <div class="absolute top-0 right-0 bg-yellow-500 text-white px-3 py-1 m-2 rounded-md text-sm">
                                    Pending
                                </div>
                            </div>
                            
                            <!-- Card Content -->
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center space-x-2">
                                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">{{ $demand->offer->place_capacity }} places</span>
                                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">{{ $demand->offer->category->name }}</span>
                                    </div>
                                    <span class="text-gray-600 text-sm">{{ $demand->offer->city }}</span>
                                </div>
                                
                                <h4 class="font-bold text-lg mb-2">{{ $demand->offer->title }}</h4>
                                
                                <div class="mb-3">
                                    <p class="text-indigo-600 font-bold">{{ $demand->offer->price }} MAD</p>
                                    <p class="text-gray-500 text-sm">({{ number_format($demand->offer->price/$demand->offer->place_capacity) }} Dirhams/person)</p>
                                </div>
                                
                                <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($demand->offer->description, 110) }}</p>
                                
                                <div class="flex space-x-2">
                                    <a href="{{ route('offers.show', $demand->offer->id) }}" class="flex-1 border border-indigo-600 text-indigo-600 py-2 px-4 rounded-md cursor-pointer text-center font-medium hover:bg-indigo-50">
                                        Show Details
                                    </a>
                                    <form action="#{{--{{ route('demands.cancel', $demand->id) }}--}}" method="POST" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full border border-red-500 text-red-500 py-2 px-4 rounded-md cursor-pointer text-center font-medium hover:bg-red-50">
                                            Cancel Demand
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Accepted Demands Section -->
        <div id="accepted" class="mb-10 hidden">
            <h3 class="text-xl font-semibold mb-4">Accepted Demands</h3>
            
            @if($acceptedDemands == 0 )
                <div class="bg-gray-100 rounded-lg p-6 text-center">
                    <p class="text-gray-500">You don't have any accepted demands.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($acceptedDemandsList as $demand)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition">
                            <!-- Card Image -->
                            <div class="relative h-48">
                                <img src="{{ asset('storage/'.$demand->offer->thumbnail) }}" alt="Offer Thumbnail" class="w-full h-full object-cover">
                                <div class="absolute top-0 right-0 bg-green-500 text-white px-3 py-1 m-2 rounded-md text-sm">
                                    Accepted
                                </div>
                            </div>
                            
                            <!-- Card Content -->
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center space-x-2">
                                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">{{ $demand->offer->place_capacity }} places</span>
                                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">{{ $demand->offer->category->name }}</span>
                                    </div>
                                    <span class="text-gray-600 text-sm">{{ $demand->offer->city }}</span>
                                </div>
                                
                                <h4 class="font-bold text-lg mb-2">{{ $demand->offer->title }}</h4>
                                
                                <div class="mb-3">
                                    <p class="text-indigo-600 font-bold">{{ $demand->offer->price }} MAD</p>
                                    <p class="text-gray-500 text-sm">({{ number_format($demand->offer->price/$demand->offer->place_capacity) }} Dirhams/person)</p>
                                </div>
                                
                                <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($demand->offer->description, 120) }}</p>
                                
                                <div class="flex space-x-2">
                                    <a href="{{ route('offers.show', $demand->offer->id) }}" class="w-1/2 border border-indigo-600 text-indigo-600 py-2 px-4 rounded-md cursor-pointer text-center font-medium hover:bg-indigo-50">
                                        Show Details
                                    </a>
                                    <form action="#{{--{{ route('demands.confirm', $demand->id) }}--}}" method="POST" class="w-1/2">
                                        @csrf
                                        @method("patch")
                                        <button type="submit" class="w-full bg-green-500 text-white py-2 px-4 rounded-md cursor-pointer text-center font-medium hover:bg-green-600">
                                            Confirm
                                        </button>
                                    </form>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Rejected Demands Section -->
        <div id="rejected" class="mb-10 hidden">
            <h3 class="text-xl font-semibold mb-4">Rejected Demands</h3>
            
            @if($rejectedDemands == 0)
                <div class="bg-gray-100 rounded-lg p-6 text-center">
                    <p class="text-gray-500">You don't have any rejected demands.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($rejectedDemands as $demand)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition">
                            <!-- Card Image -->
                            <div class="relative h-48">
                                <img src="{{ asset($demand->offer->thumbnail) }}" alt="Offer Thumbnail" class="w-full h-full object-cover">
                                <div class="absolute top-0 right-0 bg-red-500 text-white px-3 py-1 m-2 rounded-md text-sm">
                                    Rejected
                                </div>
                            </div>
                            
                            <!-- Card Content -->
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center space-x-2">
                                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">{{ $demand->offer->place_capacity }} places</span>
                                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">{{ $demand->offer->category->name }}</span>
                                    </div>
                                    <span class="text-gray-600 text-sm">{{ $demand->offer->city }}</span>
                                </div>
                                
                                <h4 class="font-bold text-lg mb-2">{{ $demand->offer->title }}</h4>
                                
                                <div class="mb-3">
                                    <p class="text-indigo-600 font-bold">{{ $demand->offer->price }} MAD</p>
                                    <p class="text-gray-500 text-sm">({{ number_format($demand->offer->price/$demand->offer->place_capacity) }} Dirhams/person)</p>
                                </div>
                                
                                <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($demand->offer->description, 120) }}</p>
                                
                                <div class="flex">
                                    <a href="{{ route('offers.show', $demand->offer->id) }}" class="w-full border border-indigo-600 text-indigo-600 py-2 px-4 rounded-md cursor-pointer text-center font-medium hover:bg-indigo-50">
                                        Show Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    @include('components.footer')

    <!-- Simple Tab Functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('ul li a');
            const sections = document.querySelectorAll('[id^="pending"], [id^="accepted"], [id^="rejected"]');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all tabs
                    tabs.forEach(t => {
                        t.classList.remove('border-indigo-600', 'text-indigo-600');
                        t.classList.add('border-transparent');
                    });
                    
                    // Add active class to current tab
                    this.classList.remove('border-transparent');
                    this.classList.add('border-indigo-600', 'text-indigo-600');
                    
                    // Hide all sections
                    sections.forEach(section => {
                        section.classList.add('hidden');
                    });
                    
                    // Show current section
                    const target = this.getAttribute('href').substring(1);
                    document.getElementById(target).classList.remove('hidden');
                });
            });
        });
    </script>
</body>
</html>