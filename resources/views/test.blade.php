<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PropertyHub - Find Your Perfect Stay</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .hero-pattern {
            background-color: #f9fafb;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23e5e7eb' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        .testimonial-card {
            transition: transform 0.3s ease-in-out;
        }
        
        .testimonial-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-gray-50">
    {{-- @include('components.header') --}}
    
    <!-- Hero Section -->
    <section class="hero-pattern py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                <div class="mb-12 lg:mb-0">
                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight">
                        Find Your Perfect <span class="text-indigo-600">Temporary Home</span>
                    </h1>
                    <p class="mt-6 text-xl text-gray-600 max-w-lg">
                        Connect with hosts around the world offering unique places to stay. Whether you're traveling or looking for a short-term solution, find the perfect space to feel at home.
                    </p>
                    <div class="mt-8">
                        <a href="{{ route('offers.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Explore Offers
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <div class="aspect-w-16 aspect-h-9 sm:aspect-w-3 sm:aspect-h-2">
                        <img class="object-cover rounded-lg shadow-xl" src="{{ asset('storage/images/hero-image.jpg') }}" alt="Cozy home interior" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1554995207-c18c203602cb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80';">
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Statistics Section -->
    <section class="py-12 bg-indigo-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 text-center">
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <div class="text-indigo-600 text-4xl font-bold mb-2">55</div>
                    <h3 class="text-xl font-semibold text-gray-800">Available Offers</h3>
                    <p class="text-gray-500 mt-2">Find a variety of properties that match your needs</p>
                </div>
                
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <div class="text-indigo-600 text-4xl font-bold mb-2">145</div>
                    <h3 class="text-xl font-semibold text-gray-800">Active Users</h3>
                    <p class="text-gray-500 mt-2">Join our growing community of hosts and guests</p>
                </div>
                
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <div class="text-indigo-600 text-4xl font-bold mb-2">142</div>
                    <h3 class="text-xl font-semibold text-gray-800">Cities Covered</h3>
                    <p class="text-gray-500 mt-2">Properties available across multiple locations</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Featured Offers Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Recent Offers</h2>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                    Check out these recently added properties available for booking
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach([12,12,12] as $offer)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-xl">
                    <div class="relative h-48">
                        <img src="hfgdfg" alt="thel" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1560185127-6a8c2d27698f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80';">
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900">helo</h3>
                        <p class="mt-2 text-gray-600">this is the desceiotion </p>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-indigo-600 font-bold text-lg">for the most of them here is th one </span>
                            <a href="#" class="text-indigo-600 hover:underline">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    
    {{-- @include('components.footer') --}}
</body>
</html>