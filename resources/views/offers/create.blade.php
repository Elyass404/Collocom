<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Offer</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-50">
    @include('components.topbar')
    @include('components.sidebar')
    
    <div class="ml-64 pt-32 p-6">
        
        
        <div class="flex-1 p-8">
            <div class="max-w-5xl mx-auto">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">Add New Offer</h1>
                    <p class="text-gray-600 mt-2">Create a new property listing by filling in the details below</p>
                </div>

                <form action="{{ route('offers.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md">
                    @csrf
                    
                    <!-- Basic Information Section -->
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Basic Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-2">
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Offer Title <span class="text-red-500">*</span></label>
                                <input type="text" name="title" id="title" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter a descriptive title for your property">
                            </div>
                            
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price (per night) <span class="text-red-500">*</span></label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    <input type="number" name="price" id="price" required min="0" step="0.01" class="w-full pl-7 pr-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" placeholder="0.00">
                                </div>
                            </div>
                            
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category <span class="text-red-500">*</span></label>
                                <select name="category" id="category" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Select a category</option>
                                    <!-- Categories will be populated from DB -->
                                    @forEach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Location Section -->
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Location</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="region" class="block text-sm font-medium text-gray-700 mb-1">Region <span class="text-red-500">*</span></label>
                                <select name="region" id="region" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Select a region</option>
                                    <!-- Regions will be populated from DB -->
                                </select>
                            </div>
                            
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City <span class="text-red-500">*</span></label>
                                <select name="city" id="city" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" disabled>
                                    <option value="">Select a city</option>
                                    <!-- Cities will be populated based on region -->
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Property Details Section -->
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Property Details</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="rooms" class="block text-sm font-medium text-gray-700 mb-1">Number of Rooms <span class="text-red-500">*</span></label>
                                <input type="number" name="rooms" id="rooms" required min="1" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" placeholder="1">
                            </div>
                            
                            <div>
                                <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Total Capacity <span class="text-red-500">*</span></label>
                                <input type="number" name="capacity" id="capacity" required min="1" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" placeholder="4">
                            </div>
                            
                            <div>
                                <label for="available_places" class="block text-sm font-medium text-gray-700 mb-1">Available Places <span class="text-red-500">*</span></label>
                                <input type="number" name="available_places" id="available_places" required min="1" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" placeholder="2">
                                <p class="mt-1 text-xs text-gray-500">Number of spots still open for booking</p>
                            </div>
                            
                            <div class="col-span-3">
                                <label for="situation" class="block text-sm font-medium text-gray-700 mb-1">Property Situation <span class="text-red-500">*</span></label>
                                <select name="situation" id="situation" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Select property situation</option>
                                    <!-- Situations will be populated from DB -->
                                </select>
                            </div>
                            
                            <div class="col-span-3">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
                                <textarea name="description" id="description" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" placeholder="Describe your property, its amenities, house rules, etc."></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Photos Section -->
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Property Photos</h2>
                        
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Thumbnail Image <span class="text-red-500">*</span></label>
                            <div class="mt-1 flex items-center">
                                <div class="flex-shrink-0 h-24 w-24 rounded-md overflow-hidden bg-gray-100 border border-dashed border-gray-300 flex justify-center items-center">
                                    <img id="thumbnail-preview" src="/api/placeholder/120/120" alt="Thumbnail preview" class="hidden h-full w-full object-cover">
                                    <span id="thumbnail-placeholder" class="text-gray-400">
                                        <i class="fas fa-image text-2xl"></i>
                                    </span>
                                </div>
                                <div class="ml-4">
                                    <div class="relative">
                                        <input type="file" name="thumbnail" id="thumbnail" accept="image/*" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                        <label for="thumbnail" class="px-4 py-2 border border-gray-300 rounded-md bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer">
                                            Choose Thumbnail
                                        </label>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">This will be the main image displayed for your listing</p>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Additional Photos <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <div class="flex items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-md">
                                    <div class="space-y-1 text-center">
                                        <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl"></i>
                                        <div class="text-sm text-gray-600">
                                            <label for="photos" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Upload photos</span>
                                                <input id="photos" name="photos[]" type="file" multiple accept="image/*" required class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB each</p>
                                    </div>
                                </div>
                                <div id="photos-preview" class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Creator Information (Auto-filled) -->
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Creator Information</h2>
                        <div>
                            <label for="creator" class="block text-sm font-medium text-gray-700 mb-1">Created By</label>
                            <input type="text" name="owner" id="creator" value="{{ Auth::user()->name }}" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-500">
                            <input type="hidden" name="owner_id" value="{{ Auth::user()->id }}">
                        </div>
                    </div>
                    
                    <!-- Submit Buttons -->
                    <div class="p-6 flex justify-end space-x-3">
                        <a href="{{ route('offers.index') }}" class="px-6 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Create Offer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // For region/city dynamic select
        document.getElementById('region').addEventListener('change', function() {
            const regionId = this.value;
            const citySelect = document.getElementById('city');
            
            if (regionId) {
                // Enable city select
                citySelect.disabled = false;
                
                // Clear existing options
                citySelect.innerHTML = '<option value="">Loading cities...</option>';
                
                // Fetch cities for selected region
                fetch(`/api/cities/${regionId}`)
                    .then(response => response.json())
                    .then(data => {
                        citySelect.innerHTML = '<option value="">Select a city</option>';
                        data.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city.id;
                            option.textContent = city.name;
                            citySelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching cities:', error);
                        citySelect.innerHTML = '<option value="">Error loading cities</option>';
                    });
            } else {
                // If no region selected, disable city select
                citySelect.disabled = true;
                citySelect.innerHTML = '<option value="">Select a city</option>';
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
            dropZone.classList.add('border-indigo-300', 'bg-indigo-50');
        }

        function unhighlight() {
            dropZone.classList.remove('border-indigo-300', 'bg-indigo-50');
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
    </script>
</body>
</html>