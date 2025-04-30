<!-- resources/views/support/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Message</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    
    @include('components.topbar')

    @include('components.sidebar')

    <!-- Main Content -->
    <div class="ml-64 pt-32 p-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Support Message Details</h1>
            <div class="flex gap-2">
                <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    Back to Dashboard
                </a>
                <form action="{{ route('support.destroy', $message->message_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                        Delete Message
                    </button>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Message Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Message Details -->
            <div class="lg:col-span-2">
                <!-- Message Subject Card -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-bold mb-4">{{ $message->subject }}</h2>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Received on {{ $message->created_at->format('M d, Y \a\t h:i A') }}</span>
                    </div>
                    <div class="border-t pt-4">
                        <p class="text-gray-700 whitespace-pre-line">{{ $message->message_content }}</p>
                    </div>
                </div>

                <!-- Reply Form -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold mb-4">Reply to Message</h2>
                    <form action="{{ route('support.reply', $message->message_id) }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="reply_subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                            <input type="text" name="reply_subject" id="reply_subject" value="RE: {{ $message->object }}" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div class="mb-4">
                            <label for="reply_content" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                            <textarea name="reply_content" id="reply_content" rows="8" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                        
                        <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                            Send Reply
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Column - Sender Info -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">Status</h2>
                        @if($message->status == "Read")
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full">Read</span>
                        @elseif($message->status == "Unread")
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full">Unread</span>
                        @endif
                    </div>
                    
                    @if($message->status != "Read")
                        <form action="{{ route('support.mark_read', $message->message_id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                                Mark as Read
                            </button>
                        </form>
                    @else
                    <form action="{{ route('support.mark_unread', $message->message_id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                            Mark as Unread
                        </button>
                    </form>
                    @endif
                </div>

                <!-- Sender Information -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold mb-4">Sender Information</h2>
                    
                    <div class="space-y-3">
                        <div class="flex items-center border-b pb-2">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                            <span>{{ $message->email }}</span>
                        </div>
                        
                        @if($message->phone_number)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span>{{ $message->phone_number }}</span>
                        </div>
                        @else
                        <div class="flex items-center text-gray-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span>Not provided</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Previous Replies Card, if applicable -->
                @if(isset($previousMessages) && count($previousMessages) > 0)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold mb-4">Previous Replies</h2>
                    
                    <div class="space-y-4">
                        @foreach($previousMessages as $message)
                        <div class="border-b pb-3">
                            <p class="text-sm text-gray-500">{{ $message->created_at->format('M d, Y \a\t h:i A') }}</p>
                            <p class="font-medium">{{ $message->object }}</p>
                            <p class="text-gray-700 text-sm mt-1">{{ Str::limit($message->message_content, 100) }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- JavaScript for Dropdown Menu -->
    <script>
        // Profile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            if (document.getElementById('profile-menu')) {
                document.getElementById('profile-menu').addEventListener('click', function() {
                    document.getElementById('menu').classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>