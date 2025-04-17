<!-- resources/views/offers/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offers</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    
    @include('components.topbar')

    @include('components.sidebar')

    <!-- Main Content -->
    <div class="ml-64 pt-32 p-6">
        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500">Total Offers</h3>
                <p class="text-2xl font-bold">{{$countOffers}}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500">Active Offers</h3>
                <p class="text-2xl font-bold">{{$activeOffers}}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500">Latest Offer</h3>
                <p class="text-2xl font-bold">{{$latestOffers}}</p>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold ">Offers</h2>
                <div class="flex gap-4">
                    <input type="text" placeholder="Search..." class="px-4 py-2 border rounded-lg">
                    <a href="{{ route('offers.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Create New Offer
                    </a>
                </div>
            </div>
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="py-2">ID</th>
                        <th class="py-2">Owner</th>
                        <th class="py-2">Pnone Number</th>
                        <th class="py-2">Region</th>
                        <th class="py-2">City</th>
                        <th class="py-2">Rooms</th>
                        <th class="py-2">Status</th>
                        <th class="py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($offers as $offer)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 text-center">{{ $offer->id }}</td>
                        <td class="py-2 text-center">{{ $offer->user_id }}</td>
                        <td class="py-2">{{ $offer->city }}</td>
                        <td class="py-2">{{ $offer->contact }}</td>
                        <td class="py-2">{{ $offer->location }}</td>
                        <td class="py-2 text-center">{{ $offer->number_of_rooms }}</td>
                        <td class="py-2">
                            @if($offer->status)
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Active</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Inactive</span>
                            @endif
                        </td>
                        <td class="py-2">
                            <a href="{{ route('offers.show', $offer->id) }}" class="px-2 py-1 bg-green-500 text-white rounded text-sm">Show</a>
                            <a href="{{ route('offers.edit', $offer->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded text-sm">Edit</a>
                            
                            @if($offer->status)
                                <form action="{{ route('offers.suspend', $offer->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded text-sm">Suspend</button>
                                </form>
                            @else
                                <form action="{{ route('offers.reactivate', $offer->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-2 py-1 bg-blue-500 text-white rounded text-sm">Activate</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Pagination -->
            <div class="flex justify-end mt-4">
                {{ $offers->links() }}
            </div>
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