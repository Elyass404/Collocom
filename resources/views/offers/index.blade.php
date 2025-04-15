<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Offers - Your App Name</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Offers</h1>
            <a href="{{ route('offers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Create New Offer
            </a>
        </div>

        <!-- Offers Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full">
                <!-- Table Header -->
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Offer ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">City</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Number of Rooms</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>

                <!-- Table Body -->
                {{-- <tbody class="divide-y divide-gray-200">
                    @foreach($offers as $offer)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $offer->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $offer->city }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $offer->contact }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $offer->location }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $offer->number_of_rooms }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <!-- Show Action -->
                            <a href="{{ route('offers.show', $offer->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">Show</a>

                            <!-- Suspend/Reactive Actions -->
                            @if($offer->is_active)
                                <form action="{{ route('offers.suspend', $offer->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Suspend</button>
                                </form>
                            @else
                                <form action="{{ route('offers.reactivate', $offer->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-green-500 hover:text-green-700">Reactive</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody> --}}
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{-- {{ $offers->links() }} --}}
        </div>
    </div>
</body>
</html>