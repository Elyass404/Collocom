<!-- resources/views/offers/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offer Details</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Add Swiper for the image carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.css"/>
    
</head>
<body class="bg-gray-100">
    
    @include('components.topbar')

    @include('components.sidebar')

    
    <!-- Main Content -->
    <div class="ml-64 pt-32 p-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">{{$offer->title}}</h1>
            <div class="flex gap-2">
                <a href="{{ route('offers.edit', $offer->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                    Edit Offer
                </a>
                <a href="{{ route('offers.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    Back to Offers
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        

        <!-- Offer Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Images -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Image Carousel -->
                    <div class="swiper offerSwiper">
                        <div class="swiper-wrapper">
                            @forelse($photos as $photo)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/'. $photo->photo) }}" alt="Offer Image" class="w-full h-96 object-contain">
                                </div>
                            @empty
                                <div class="swiper-slide">
                                    <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                                        <p class="text-gray-500">No images available</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <div class="swiper-button-next text-white"></div>
                        <div class="swiper-button-prev text-white"></div>
                        <div class="swiper-pagination"></div>
                    </div>

                    <!-- Thumbnails -->
                    <div class="p-4 grid grid-cols-5 gap-2">
                        @forelse($photos as $index => $photo)
                            <img src="{{ asset('storage/' . $photo->photo) }}" alt="Thumbnail" 
                                class="w-full h-20 object-cover rounded cursor-pointer thumbnail" 
                                data-index="{{ $index }}">
                        @empty
                            <div class="w-full h-20 bg-gray-200 rounded flex items-center justify-center">
                                <p class="text-gray-500">No thumbnails available</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Property Description Card -->
                <div class="bg-white rounded-lg shadow-md p-6 mt-6">
                    <h2 class="text-xl font-bold mb-4">Property Description</h2>
                    <p class="text-gray-700">{{ $offer->description ?? 'No description available.' }}</p>
                </div>
            </div>

            <!-- Right Column - Details -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold">Status</h2>
                        @if($offer->status == "Active")
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full">Active</span>
                        @else
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full">Inactive</span>
                        @endif
                    </div>
                    <div class="mt-4">
                        @if($offer->status == "Active")
                            <form action="{{ route('offers.suspend', $offer->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                    Suspend Offer
                                </button>
                            </form>
                        @else
                            <form action="{{ route('offers.reactivate', $offer->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                                    Activate Offer
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- Price Card -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold mb-2">Price</h2>
                    <p class="text-3xl font-bold text-blue-600">MAD {{ number_format($offer->price, 2) }}</p>
                    <p class="text-sm text-gray-500">Created on {{ $offer->created_at->format('M d, Y') }}</p>
                    <p class="text-sm text-gray-500">{{ ($offer->price)/($offer->place_capacity)}} per person</p>
                </div>

                <!-- Property Details Card -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold mb-4">Property Details</h2>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-500">Property Type</span>
                            <span class="font-medium">{{ $offer->category->name ?? 'Not specified' }}</span>
                        </div>
                        
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-500">Region</span>
                            <span class="font-medium">{{ $offer->region }}</span>
                        </div>
                        
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-500">City</span>
                            <span class="font-medium">{{ $offer->city }}</span>
                        </div>
                        
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-500">Number of Rooms</span>
                            <span class="font-medium">{{ $offer->number_of_rooms }}</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-500">{{--{{$offer->category->name}}--}}Capacity Of Property</span>
                            <span class="font-medium">{{ $offer->place_capacity }}</span>
                        </div>
                    </div>
                </div>

                <!-- Contact Info Card -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold mb-4">Contact Information</h2>
                    
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span>{{ $offer->Owner->phone_number }}</span>
                        </div>
                        
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                            <span>{{ $offer->Owner->email ?? 'Not provided' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Delete Button -->
                <div>
                    <form action="{{ route('offers.destroy', $offer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this offer?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                            Delete Offer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Dropdown Menu -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
    <script>
        // Initialize Swiper
        var swiper = new Swiper(".offerSwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        // Thumbnail click handling
        document.addEventListener('DOMContentLoaded', function() {
            const thumbnails = document.querySelectorAll('.thumbnail');
            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    const index = parseInt(this.dataset.index);
                    swiper.slideTo(index + 1); // +1 because of loop mode
                });
            });
        });

        // Profile menu toggle
        document.getElementById('profile-menu').addEventListener('click', function() {
            document.getElementById('menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>


{{-- hello claude, thanks for the view you are providing me withi do really appreciate it, now iam looking for a view for the 
form of adding the offer, this form is a little long so i want you to make a layout that wont make the user feel boored or somthing like that
the form should be consistent with the style of other view, but at the same time i want it in a modern, clean, way, and it should be userfriendly, 
the form of the offers will contain the following information input:
title ,
price, 
category (select input that shows the categories available in the DB),
region (select input also),
city(select input, depending on the value of the region select input),
number of rooms (number),
capacity of property (number input),
thumbnail(photo in put, so we can know which photo the user want to use as thumbnail),
photos(photos of the property the user uplaods, so the user shows the photos of the property)
available places(number of places available in the property so even the capacity is 4 but available places could be just 1 because we want 1 to finish the wanted number of people inside that house or property in general),
description(so the publisher of the offer can add other thing about the offer, of to clarify something)
situation (select input also from the situation created in the DB )
creator (this field is a disabled field and has the name of the authenticated user, automatically )

NOTE :dont follow strictlly the order of i gave you, you arrange the inputs depending on a good user experience and what should be in which order
Note: you includ the components as the previous views(the sidebar  and the topbar) --}}


