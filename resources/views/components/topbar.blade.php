<!-- resources/views/components/topbar.blade.php -->
<div class="bg-white shadow-md fixed w-full z-10">
    <div class="container mx-auto flex justify-between items-center py-4">
        <div class="text-xl font-bold">
            <a href="{{route("home")}}">
            <span><img src="{{asset("images/logos/collocom_full_logo_blue.svg")}}" class="h-8 w-auto" alt="Collocom logo"></span></div>
        <div class="flex items-center space-x-4">
        </a>
            <span class="text-gray-700">{{Auth::user()->name}}</span>
            <img src="{{asset('storage/'.Auth::user()->profile_picture)}}" alt="Profile" class="w-10 h-10 rounded-full">
            <div class="relative">
                <button id="profile-menu" class="focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <!-- Dropdown Menu -->
                <div id="menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg">
                    <a href="{{route('users.profile',Auth::id())}}" class="block px-4 py-2 text-left w-full text-gray-700 hover:bg-gray-100">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block px-4 py-2 text-left w-full text-gray-700 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>