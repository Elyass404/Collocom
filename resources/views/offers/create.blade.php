<!-- resources/views/offers/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Offer</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Include Top Bar -->
    @include('components.topbar')

    <!-- Include Sidebar -->
    @include('components.sidebar')

    <!-- Main Content -->
    <div class="ml-64 pt-32 p-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">Create New Offer</h1>

            <!-- Create Offer Form -->
            <form action="{{-- {{ route('offers.store') }}--}}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- City -->
                <div class="mb-4">
                    <label for="city" class="block text-gray-700">City</label>
                    <input type="text" name="city" id="city" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <!-- Contact -->
                <div class="mb-4">
                    <label for="contact" class="block text-gray-700">Contact Information</label>
                    <input type="text" name="contact" id="contact" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <!-- Monthly Cost -->
                <div class="mb-4">
                    <label for="monthly_cost" class="block text-gray-700">Monthly Cost</label>
                    <input type="number" name="monthly_cost" id="monthly_cost" min="0" step="0.01" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <!-- Needed Places -->
                <div class="mb-4">
                    <label for="needed_places" class="block text-gray-700">Needed Places</label>
                    <input type="number" name="needed_places" id="needed_places" min="1" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <!-- Location -->
                <div class="mb-4">
                    <label for="location" class="block text-gray-700">Location</label>
                    <input type="text" name="location" id="location" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <!-- Photos -->
                <div class="mb-4">
                    <label for="photos" class="block text-gray-700">Offer Photos</label>
                    <input type="file" name="photos[]" id="photos" multiple accept="image/*" class="w-full px-4 py-2 border rounded-lg">
                    <p class="text-sm text-gray-600 mt-1">You can upload multiple photos</p>
                </div>

                <!-- Number of Rooms -->
                <div class="mb-4">
                    <label for="number_of_rooms" class="block text-gray-700">Number of Rooms</label>
                    <input type="number" name="number_of_rooms" id="number_of_rooms" min="1" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <!-- Tags -->
                <div class="mb-4">
                    <label class="block text-gray-700">Tags</label>
                    <div class="flex flex-wrap">
                        {{-- @foreach($tags as $tag)
                            <div class="mr-4 mb-2">
                                <input type="checkbox" name="tags[]" id="tag_{{ $tag->id }}" value="{{ $tag->id }}" class="mr-2">
                                <label for="tag_{{ $tag->id }}" class="text-gray-700">{{ $tag->name }}</label>
                            </div>
                        @endforeach --}}
                        <input type="checkbox" name="tags[]" id="tagid" value="hello tag" class="mr-2">
                        <label for="hello" class="text-gray-700">hello tag</label>

                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Create Offer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript for Dropdown Menu -->
    <script>
        document.getElementById('profile-menu').addEventListener('click', function() {
            document.getElementById('menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>