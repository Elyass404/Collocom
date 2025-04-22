@extends('layouts.app')

@section('content')
    <!-- Page Header -->
    <section class="bg-indigo-700 py-10 mt-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold text-white sm:text-4xl">Find Your suitable Property</h1>
            <p class="mt-3 text-indigo-100 text-lg">Browse all available offers and find the perfect place to call home</p>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="bg-white shadow-md sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <form class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-1">City</label>
                    <select class="border rounded-md py-2 px-3">
                        <option>All Cities</option>
                        <option>City 1</option>
                        <option>City 2</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-1">Property Type</label>
                    <select class="border rounded-md py-2 px-3">
                        <option>All Types</option>
                        <option>Type 1</option>
                        <option>Type 2</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-1">Max Price (MAD)</label>
                    <input type="number" placeholder="Max Price" class="border rounded-md py-2 px-3">
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-1">Capacity</label>
                    <input type="number" placeholder="Number of people" min="1" class="border rounded-md py-2 px-3">
                </div>

                <div class="flex items-end">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md">
                        Filter Results
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-10 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                <div class="mb-4 md:mb-0">
                    <p class="text-gray-700">Showing <span class="font-semibold">0</span> of <span class="font-semibold">0</span> offers</p>
                </div>
                <div class="flex items-center">
                    <label class="text-sm font-medium text-gray-700 mr-2">Sort by:</label>
                    <select class="border rounded-md py-2 px-3">
                        <option>Latest</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                    </select>
                </div>
            </div>

            <!-- No Results Message -->
            <div class="bg-white p-8 rounded-lg shadow-md text-center">
                <h3 class="text-lg font-medium text-gray-900 mb-2">No offers found</h3>
                <p class="text-gray-600 mb-4">Try adjusting your filters or browse all available offers.</p>
                <a class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Clear Filters
                </a>
            </div>

            <!-- Offers Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
                {{-- the foreach loop in here  --}}
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="relative h-48">
                        <img src="/placeholder.jpg" alt="Thumbnail" class="w-full h-full object-cover">
                        <div class="absolute top-0 right-0 bg-indigo-600 text-white px-3 py-1 m-2 rounded-md text-sm font-semibold">2</div>
                        <div class="absolute top-0 left-0 bg-black bg-opacity-70 text-white px-3 py-1 m-2 rounded-md text-sm font-semibold">Category</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-2">
                            <span class="text-gray-700 text-sm">City Name</span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Offer Title</h3>
                        <p class="text-indigo-600 font-bold text-lg mt-1">MAD 0 <span class="text-black text-base font-normal">(0/person)</span></p>
                        <p class="mt-2 text-gray-600">Offer description goes here...</p>
                        <div class="mt-4 flex items-center justify-between space-x-2">
                            <a class="flex-1 border border-indigo-600 text-indigo-600 py-2 px-4 rounded-md text-center font-medium hover:bg-indigo-50">See Details</a>
                            <a class="flex-1 bg-indigo-600 text-white py-2 px-4 rounded-md text-center font-medium hover:bg-indigo-700">Ask to Join</a>
                        </div>
                    </div>
                </div>
                {{-- the end of the foreach in here  --}}
            </div>

            <!-- Pagination -->
            <div class="mt-8 text-center text-gray-500">Pagination here...</div>
        </div>
    </section>
@endsection
