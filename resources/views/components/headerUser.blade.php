<header class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-full shadow-md">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{route("home")}}" class="flex items-center">
                            <img src="{{asset("images/logos/collocom_full_logo_blue.svg")}}" alt="Collocom logo" class="h-8 w-auto">
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{route('home')}}" class="text-gray-500 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Home
                        </a>
                        <a href="{{route('offers.offers_list')}}" class="text-gray-500 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Offers
                        </a>
                        <a href="{{route('about_us')}}" class="text-gray-500 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            About Us
                        </a>
                        <a href="{{route("contact_us")}}" class="text-gray-500 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Contact
                        </a>
                    </div>
                </div>

                <!-- Right side buttons (static look, no auth logic) -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    @auth
                    <a href="{{route("createOffer")}}" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                        Create Offer
                    </a>
                    <div class="ml-3 relative">
                        <div class="flex items-center">
                            <button type="button" class="bg-white rounded-full flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="user-menu-button">
                                <span class="sr-only">Open user menu</span>
                                @if(!is_null(Auth::user()->profile_picture))
                                <span class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                    <img class="rounded-full" src="{{asset('storage/'.Auth::user()->profile_picture)}}" alt="user_picture">
                                </span>
                                @else
                                <span class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center font-bold ">{{substr(Auth::user()->name, 0, 1)}}</span>
                                @endif
                            </button>
                        </div>
                        <div id="user-dropdown" class="hidden z-30 origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5">
                            <a href="{{route("users.profile",Auth::id())}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Profile</a>
                            <a href="{{route('my_offer')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Offer</a>
                            <a href="{{route('my_offer.demands')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manage Demands</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <a href="{{route("login")}}" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                        Login
                    </a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" id="mobile-menu-button">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="hidden sm:hidden bg-white mt-2 rounded-xl shadow-md" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{route('home')}}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium text-gray-500 hover:text-gray-700">Home</a>
            <a href="{{route('offers.offers_list')}}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium text-gray-500 hover:text-gray-700">Offers</a>
            <a href="{{route('about_us')}}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium text-gray-500 hover:text-gray-700">About Us</a>
            <a href="{{route('contact_us')}}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium text-gray-500 hover:text-gray-700">Contact</a>
            <a href="{{route('offers.create')}}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium text-indigo-600 hover:bg-gray-50 hover:border-gray-300">Create Offer</a>
        </div>

        @auth
        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="flex items-center px-4">
            <div class="flex-shrink-0">
                @if(!is_null(Auth::user()->profile_picture))
                <span class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                <img class="rounded-full" src="{{asset('storage/'.Auth::user()->profile_picture)}}" alt="user_picture">
                </span>
                @else
                <span class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center font-bold">
                {{substr(Auth::user()->name, 0, 1)}}
                </span>
                @endif
            </div>
            <div class="ml-3">
                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            </div>
            <div class="mt-3 space-y-1">
            <a href="{{route('users.profile', Auth::id())}}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Your Profile</a>
            <a href="{{route('my_offer')}}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">My Offers</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Sign out</button>
            </form>
            </div>
        </div>
        @endauth
    </div>
</header>

<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function () {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });

    const userMenuButton = document.getElementById('user-menu-button');
    if (userMenuButton) {
        userMenuButton.addEventListener('click', function () {
            const dropdown = document.getElementById('user-dropdown');
            dropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function (event) {
            const dropdown = document.getElementById('user-dropdown');
            if (!dropdown.contains(event.target) && !userMenuButton.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    }
</script>