<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Collocom Platform</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>
<body class="bg-gray-50">
    <!-- Header -->
    @include('components.headerUser')

    <!-- Hero Section -->
    <section class="hero-pattern py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight">
                    About <span class="text-indigo-600">Collocom</span>
                </h1>
                <p class="mt-6 text-xl text-gray-600 max-w-3xl mx-auto">
                    Connecting people with properties to those seeking shared living spaces
                </p>
            </div>
        </div>
    </section>

    <!-- Our Mission -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-12 items-center">
                <div class="mb-12 lg:mb-0">
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                        Our Mission
                    </h2>
                    <p class="mt-6 text-lg text-gray-600">
                        At Collocom, we believe finding the right roommate should be simple, safe, and stress-free. 
                        Whether you've found a great property and need roommates to share costs, or you're looking to join 
                        an existing shared living situation, our platform makes the process effortless.
                    </p>
                    <p class="mt-4 text-lg text-gray-600">
                        We're transforming the way people connect for shared living by providing a platform that puts 
                        control in the hands of property finders while giving applicants a clear, organized way to 
                        express interest.
                    </p>
                </div>
                <div class="relative rounded-xl overflow-hidden shadow-xl">
                    <img src="https://images.unsplash.com/photo-1556911220-bff31c812dba?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1180&q=80" 
                         alt="Happy roommates in shared living space" 
                         class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">How It Works</h2>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                    Our simple three-step process for finding or filling shared living spaces
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="bg-white p-8 rounded-lg shadow-md text-center feature-card">
                    <div class="inline-flex items-center justify-center p-3 bg-indigo-100 rounded-full text-indigo-600 mb-4">
                        <span class="text-2xl font-bold">1</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">List or Browse</h3>
                    <p class="mt-4 text-gray-600">
                        Property finders create detailed listings. Roommate seekers browse available spaces with photos, 
                        amenities, and pricing.
                    </p>
                </div>
                
                <!-- Step 2 -->
                <div class="bg-white p-8 rounded-lg shadow-md text-center feature-card">
                    <div class="inline-flex items-center justify-center p-3 bg-indigo-100 rounded-full text-indigo-600 mb-4">
                        <span class="text-2xl font-bold">2</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Connect</h3>
                    <p class="mt-4 text-gray-600">
                        Interested applicants submit requests to join. Property owners review profiles and requests to 
                        find the best matches.
                    </p>
                </div>
                
                <!-- Step 3 -->
                <div class="bg-white p-8 rounded-lg shadow-md text-center feature-card">
                    <div class="inline-flex items-center justify-center p-3 bg-indigo-100 rounded-full text-indigo-600 mb-4">
                        <span class="text-2xl font-bold">3</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Move In</h3>
                    <p class="mt-4 text-gray-600">
                        Once accepted, roommates coordinate move-in details and begin their shared living arrangement.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Why Choose Collocom</h2>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                    The smarter way to find roommates for your property
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="inline-flex items-center justify-center p-2 bg-indigo-100 rounded-md text-indigo-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Verified Users</h3>
                    <p class="mt-4 text-gray-600">
                        Our verification system helps ensure you're connecting with real people who are serious about shared living.
                    </p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="inline-flex items-center justify-center p-2 bg-indigo-100 rounded-md text-indigo-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Transparent Pricing</h3>
                    <p class="mt-4 text-gray-600">
                        Clear cost breakdowns show exactly what each roommate pays, with no hidden fees or surprises.
                    </p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="inline-flex items-center justify-center p-2 bg-indigo-100 rounded-md text-indigo-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Direct Messaging</h3>
                    <p class="mt-4 text-gray-600">
                        Communicate securely within our platform to ask questions and get to know potential roommates.
                    </p>
                </div>
                
                <!-- Feature 4 -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="inline-flex items-center justify-center p-2 bg-indigo-100 rounded-md text-indigo-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Secure Process</h3>
                    <p class="mt-4 text-gray-600">
                        Your personal information stays protected until you choose to share it with potential matches.
                    </p>
                </div>
                
                <!-- Feature 5 -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="inline-flex items-center justify-center p-2 bg-indigo-100 rounded-md text-indigo-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Wide Network</h3>
                    <p class="mt-4 text-gray-600">
                        Access to a diverse community of potential roommates across multiple cities and neighborhoods.
                    </p>
                </div>
                
                <!-- Feature 6 -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="inline-flex items-center justify-center p-2 bg-indigo-100 rounded-md text-indigo-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Property Control</h3>
                    <p class="mt-4 text-gray-600">
                        As the property finder, you maintain full control over who gets accepted into your shared space.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-indigo-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                Ready to find your perfect roommate match?
            </h2>
            <p class="mt-4 text-xl text-indigo-100 max-w-3xl mx-auto">
                Join thousands of others who've found ideal shared living situations through our platform.
            </p>
            <div class="mt-8">
                <a href="{{route('createOffer')}}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-indigo-700 bg-white hover:bg-indigo-50">
                    Create Your First Offer
                </a>
                <a href="{{route('offers.offers_list')}}" class="ml-4 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 bg-opacity-60 hover:bg-opacity-70">
                    Browse Available Properties
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('components.footer')
</body>
</html>