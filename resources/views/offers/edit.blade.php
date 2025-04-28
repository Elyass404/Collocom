<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Offer</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-50">
    @include("components.headerUser")
    
    <div class="max-w-5xl mx-auto pt-8 p-6">
        <!-- Error display -->
        @if ($errors->any())
        <div class="bg-red-50 text-red-700 p-4 rounded-lg mb-6">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Form Header with Cancel Button -->
            <div class="bg-indigo-600 text-white p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold">Edit your Offer</h1>
                        <p class="mt-1 text-indigo-100">Modify your property by filling in the new details below</p>
                    </div>
                    <a href="{{ url()->previous() }}" class="px-4 py-2 bg-white text-indigo-600 rounded-md hover:bg-indigo-50 transition-colors font-medium">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                </div>
            </div>

            <form action="{{ route('offers.update',$offer->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                
                <!-- Basic Information Section -->
                <div class="p-6 border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Offer Title <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" value="{{$offer->title}}" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" placeholder="A short, descriptive title for your property">
                        </div>
                        
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Monthly Rent <span class="text-red-500">*</span></label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">MAD</span>
                                </div>
                                <input type="number" name="price" id="price" required value="{{$offer->price}}" min="0" step="0.01" class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" placeholder="0.00">
                            </div>
                        </div>
                        
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Property Type <span class="text-red-500">*</span></label>
                            <select name="category_id" id="category" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Select property type</option>
                                @forEach($categories as $category)

                                <option value="{{$category->id}}" {{$category == $offer->category ? "selected":""}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Location Section -->
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Location</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="region" class="block text-sm font-medium text-gray-700 mb-1">Region <span class="text-red-500">*</span></label>
                            <select name="region" id="region" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Select a region</option>
                                @forEach($regions as $region)
                                <option value="{{$region->region}}" {{$region->region == $offer->region ? "selected":""}}>{{$region->region}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City <span class="text-red-500">*</span></label>
                            <select name="city" id="city" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" {{$offer->city ? "":"disabled"}}>
                                <option value="">Select a city</option>
                            </select>
                            <p class="mt-1 text-xs text-gray-500">First select a region to enable city selection</p>
                        </div>
                    </div>
                </div>
                
                <!-- Property Details Section -->
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Property Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="rooms" class="block text-sm font-medium text-gray-700 mb-1">Number of Rooms <span class="text-red-500">*</span></label>
                            <input type="number" name="rooms" id="rooms" required value="{{$offer->number_of_rooms}}" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" placeholder="1">
                            <p class="mt-1 text-xs text-gray-500">Total number of bedrooms</p>
                        </div>
                        
                        <div>
                            <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Total Capacity <span class="text-red-500">*</span></label>
                            <input type="number" name="capacity" id="capacity" required value="{{$offer->place_capacity}}" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" placeholder="4">
                            <p class="mt-1 text-xs text-gray-500">Maximum number of people</p>
                        </div>
                        
                        <div>
                            <label for="available_places" class="block text-sm font-medium text-gray-700 mb-1">Available Places <span class="text-red-500">*</span></label>
                            <input type="number" name="available_places" id="available_places" required value="{{$offer->available_places}}" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" placeholder="2">
                            <p class="mt-1 text-xs text-gray-500">Number of spots currently available</p>
                        </div>
                        
                        <div class="col-span-3">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
                            <textarea name="description" id="description" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" placeholder="Describe your property, amenities, house rules, nearby attractions, etc."> {{$offer->description}}</textarea>
                            <p class="mt-1 text-xs text-gray-500">Be detailed and highlight what makes your property special</p>
                        </div>
                    </div>
                </div>
                
                <!-- Photos Section -->
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Property Photos</h2>
                    <p class="text-sm text-gray-600 mb-4">High-quality photos significantly increase interest in your property</p>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Main Photo <span class="text-red-500">*</span></label>
                        <div class="mt-1 flex items-center">
                            <div class="flex-shrink-0 h-32 w-32 rounded-md overflow-hidden bg-gray-100 border border-dashed border-gray-300 flex justify-center items-center">
                                @if($offer->thumbnail)
                                <img id="thumbnail-preview" src="{{asset('storage/' . $offer->thumbnail)}}" alt="Thumbnail preview" class=" h-full w-full object-cover">
                                @else
                                <img id="thumbnail-preview" src="/api/placeholder/128/128" alt="Thumbnail preview" class=" h-full w-full object-cover">
                                <span id="thumbnail-placeholder" class="text-gray-400">
                                    <i class="fas fa-image text-3xl"></i>
                                </span>
                                @endif
                            </div>
                            
                            <div class="ml-5">
                                <div class="relative">
                                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                    <label for="thumbnail" class="px-4 py-2 border border-gray-300 rounded-md bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer">
                                        <i class="fas fa-upload mr-2"></i> Select Main Photo
                                    </label>
                                </div>
                                <p class="mt-2 text-xs text-gray-500">This will be the main image displayed for your listing</p>
                                <p class="text-xs text-gray-500">Recommended: landscape orientation, at least 1000×750px</p>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Additional Photos <span class="text-red-500">*</span></label>
                        <p class="text-xs text-gray-500 mb-2">Upload at least 3 additional photos of your property</p>
                        
                        <div class="mt-1">
                            <div class="flex items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-md bg-gray-50">
                                <div class="space-y-1 text-center">
                                    <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl"></i>
                                    <div class="text-sm text-gray-600">
                                        <label for="photos" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Upload photos</span>
                                            <input id="photos" name="photos[]" type="file" multiple accept="image/*" {{ isset($offerPhotos) ? '' : 'required' }} class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB each</p>
                                </div>
                            </div>
                            @if($offerPhotos)
                            <div id="photos-preview" class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                @foreach(json_decode($offerPhotos) as $photo)
                                    <div class="relative h-24 bg-gray-100 rounded-md overflow-hidden">
                                    <img src="{{ asset('storage/' . $photo->photo) }}" class="h-full w-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                               
                                @endif
                            <p class="mt-2 text-xs text-gray-500">Try to include photos of all rooms, exterior views, and special features</p>
                        </div>
                    </div>
                </div>
                
                <!-- Hidden Owner Information -->
                <input type="hidden" name="owner_id" value="{{ Auth::user()->id }}">
                
                <!-- Creator Information (Auto-filled) -->
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Creator Information</h2>
                    <div>
                        <label for="creator" class="block text-sm font-medium text-gray-700 mb-1">Created By</label>
                        <input type="text" name="owner" id="creator" value="{{$offerCreator->name}}" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-500">
                        <input type="hidden" name="owner_id" value="{{ $offerCreator->id }}">
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="p-6 bg-gray-50 flex justify-between space-x-3">
                    <a href="{{ url()->previous()}}" class="px-6 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-times mr-2"></i> Cancel
                    </a>
                    <button type="submit" class="px-8 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-check mr-2"></i> Update Offer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Convert PHP arrays to JavaScript arrays
        const allCities = @json($cities);
        const allRegions = @json($regions);
        
        document.addEventListener('DOMContentLoaded', function() {
            // Get the region and city select elements
            //NOTE: (i transformed them into json to make them possible to play with in js code)
            const regionSelect = document.getElementById('region');
            const citySelect = document.getElementById('city');

            //bring the name of the city of the offer brought from the controller 
            const offerCity = @json($offer->city);

            if (typeof(regionSelect.value) == "string"){ // just checking if the value s there, and also it should be a string
                let selectedRegionName = regionSelect.value;
                let regionId = allRegions.filter(region => region.region === selectedRegionName);
                    // Filter cities that belong to the selected region
                    const filteredCities = allCities.filter(city => city.region === regionId[0].id);
                    
                    // Add filtered cities to dropdown
                    filteredCities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.city;
                        option.textContent = city.city;
                        if(option.value === offerCity){ //the offerCity is the one that holds the city of the brought offer from the controller
                            option.selected = true;
                        }
                        citySelect.appendChild(option);
                    });
            }

            // Add event listener to region select
            regionSelect.addEventListener('change', function() {
                const selectedRegionName = this.value;
                
                // Reset city dropdown
                citySelect.innerHTML = '<option value="">Select a city</option>';
                
                if (selectedRegionName) {
                    // Enable city select
                    citySelect.disabled = false;

                    let regionId = allRegions.filter(region => region.region === selectedRegionName);
                    
                    // Filter cities that belong to the selected region
                    const filteredCities = allCities.filter(city => city.region === regionId[0].id);
                    
                    // Add filtered cities to dropdown
                    filteredCities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.city;
                        option.textContent = city.city;
                        citySelect.appendChild(option);
                    });
                } else {
                    // If no region selected, keep city select disabled
                    citySelect.disabled = true;
                }
            });
            
            
            // Thumbnail preview
document.getElementById('thumbnail').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('thumbnail-preview');
            const placeholder = document.getElementById('thumbnail-placeholder');
            
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
        reader.readAsDataURL(file);
    }
});

            // Multiple photos preview
document.getElementById('photos').addEventListener('change', function(e) {
    const previewContainer = document.getElementById('photos-preview');
    // Clear all existing previews when new files are selected
    previewContainer.innerHTML = '';
    
    Array.from(e.target.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const previewBox = document.createElement('div');
            previewBox.className = 'relative h-24 bg-gray-100 rounded-md overflow-hidden';
            
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'h-full w-full object-cover';
            
            previewBox.appendChild(img);
            previewContainer.appendChild(previewBox);
        }
        reader.readAsDataURL(file);
    });
});

            // Drag and drop functionality for photos
            const dropZone = document.querySelector('.border-dashed');
            const photosInput = document.getElementById('photos');

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                dropZone.classList.add('border-indigo-300', 'bg-indigo-100');
            }

            function unhighlight() {
                dropZone.classList.remove('border-indigo-300', 'bg-indigo-100');
            }

            dropZone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                photosInput.files = files;
                
                // Trigger change event to update preview
                const event = new Event('change', { bubbles: true });
                photosInput.dispatchEvent(event);
            }
        });
    </script>
</body>
</html>