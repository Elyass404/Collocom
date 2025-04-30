<!-- resources/views/messages/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
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
                <h3 class="text-gray-500">Total Messages</h3>
                <p class="text-2xl font-bold">{{$countMessages}}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500">Unread Messages</h3>
                <p class="text-2xl font-bold">{{$unreadMessages}}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500">Latest Message</h3>
                <p class="text-2xl font-bold">{{$latestMessages}}</p>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Messages</h2>
                <div class="flex gap-4">
                    <input type="text" placeholder="Search..." class="px-4 py-2 border rounded-lg">
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
                        <th class="py-2">Sender</th>
                        <th class="py-2">Object</th>
                        <th class="py-2">Date</th>
                        <th class="py-2">Status</th>
                        <th class="py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $message)
                    <tr class="border-b hover:bg-gray-50 {{ $message->status == 'Unread' ? 'font-semibold' : '' }}">
                        <td class="py-2 text-center">{{ $message->message_id }}</td>
                        <td class="py-2 text-center">{{ $message->name}}</td>
                        <td class="py-2 text-center">{{ $message->object }}</td>
                        <td class="py-2 text-center">{{ $message->created_at->format('Y-m-d H:i') }}</td>
                        <td class="py-2 text-center">
                            @if($message->status == "Read")
                                <span class="px-2 py-1 bg-green-100 text-green-600 rounded-full text-xs">Read</span>
                            @elseif($message->status == "Unread")
                                <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded-full text-xs">Unread</span>
                            @endif
                        </td>
                        <td class="py-2 text-center">
                            <a href="{{ route('support.show', $message->message_id) }}" class="px-2 py-1 bg-green-500 text-white rounded text-sm">Show</a>
                            
                            @if($message->status == "Unread")
                                <form action="{{ route('support.mark_read', $message->message_id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-2 py-1 bg-blue-500 text-white rounded text-sm">Mark as Read</button>
                                </form>
                            @else
                                <form action="{{ route('support.mark_unread', $message->message_id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-2 py-1 bg-orange-500 text-white rounded text-sm">Mark as Unread</button>
                            </form>
                            @endif
                            
                            <form method="POST" action="{{ route('support.destroy', $message->message_id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded text-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Pagination -->
            <div class="flex justify-end mt-4">
                {{ $messages->links() }}
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