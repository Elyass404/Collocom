<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PropertyHub - Contact Us</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .contact-card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
        }
        
        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .form-input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }
        
        .map-container {
            height: 400px;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header Component -->
    @include('components.headerUser')
    
    <!-- Hero Section -->
    <section class="bg-indigo-700 py-16 mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-white leading-tight mb-4">
                Get in Touch
            </h1>
            <p class="text-xl text-indigo-100 max-w-2xl mx-auto">
                Have questions about Collocom? We're here to help you find your perfect temporary home.
            </p>
        </div>
    </section>
    
    <!-- Contact Information Cards -->
    <section class="py-12 -mt-10 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1: Email -->
                <div class="bg-white rounded-lg shadow-md p-6 text-center contact-card">
                    <div class="inline-flex items-center justify-center p-3 bg-indigo-100 rounded-full text-indigo-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Email Us</h3>
                    <p class="text-gray-600 mb-4">Our team is here to help with any questions</p>
                    <a href="mailto:contact@propertyhub.com" class="text-indigo-600 font-medium hover:text-indigo-500">contact@propertyhub.com</a>
                </div>
                
                <!-- Card 2: Phone -->
                <div class="bg-white rounded-lg shadow-md p-6 text-center contact-card">
                    <div class="inline-flex items-center justify-center p-3 bg-indigo-100 rounded-full text-indigo-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Call Us</h3>
                    <p class="text-gray-600 mb-4">Available Monday-Friday, 9am-5pm</p>
                    <a href="tel:+212600000000" class="text-indigo-600 font-medium hover:text-indigo-500">+212 600-000-000</a>
                </div>
                
                <!-- Card 3: Office -->
                <div class="bg-white rounded-lg shadow-md p-6 text-center contact-card">
                    <div class="inline-flex items-center justify-center p-3 bg-indigo-100 rounded-full text-indigo-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Visit Us</h3>
                    <p class="text-gray-600 mb-4">Come say hello at our office</p>
                    <p class="text-indigo-600 font-medium">Casablanca, Morocco</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Contact Form Section -->
    <section class="py-12 bg-white">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-md">
            <div class="flex items-center mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <h3 class="text-red-800 font-medium">Please correct the following errors:</h3>
            </div>
            <ul class="list-disc ml-5 text-red-700 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Send us a Message</h2>
                <p class="text-lg text-gray-600 mb-8">
                    Fill out the form below and we'll get back to you as soon as possible.
                </p>
                <form action="{{route("support.sendMessage")}}" method="POST" class="space-y-6 w-full">
                    @csrf
                    <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" name="name" id="name" value="{{old('name')}}" class="form-input block w-full border border-gray-300 rounded-md shadow-sm py-3 px-4 focus:outline-none" placeholder="Your name" required>
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="email" class="form-input block w-full border border-gray-300 rounded-md shadow-sm py-3 px-4 focus:outline-none" placeholder="your.email@example.com" required>
                        </div>
                    </div>
                    
                    <!-- Phone Number -->
                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="tel" name="phone_number" id="phone_number" class="form-input block w-full border border-gray-300 rounded-md shadow-sm py-3 px-4 focus:outline-none" placeholder="Your phone number">
                    </div>
                    
                    <!-- object -->
                    <div>
                        <label for="object" class="block text-sm font-medium text-gray-700 mb-1">Object</label>
                        <input type="text" name="object" id="object" class="form-input block w-full border border-gray-300 rounded-md shadow-sm py-3 px-4 focus:outline-none" placeholder="How can we help you?" required>
                    </div>
                    
                    <!-- Message -->
                    <div>
                        <label for="message_content	" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea name="message_content" id="message_content" rows="5" class="form-input block w-full border border-gray-300 rounded-md shadow-sm py-3 px-4 focus:outline-none" placeholder="Tell us more about your inquiry..." required></textarea>
                    </div>
                    
                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                            </svg>
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    
    <!-- Social Media Section -->
    <section class="py-12 bg-indigo-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Connect With Us</h2>
            <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                Stay updated with our content and news by following us on social media
            </p>
            
            <div class="flex justify-center space-x-6">
                <a href="https://www.instagram.com/ilyass.drafts/" class="text-indigo-600 hover:text-indigo-500 transition-colors">
                    <span class="sr-only">Facebook</span>
                    <i class="fab fa-facebook fa-2x"></i>
                </a>
                <a href="https://www.instagram.com/ilyass.drafts/" class="text-indigo-600 hover:text-indigo-500 transition-colors">
                    <span class="sr-only">Instagram</span>
                    <i class="fab fa-instagram fa-2x"></i>
                </a>
                <a href="https://www.instagram.com/ilyass.drafts/" class="text-indigo-600 hover:text-indigo-500 transition-colors">
                    <span class="sr-only">Twitter</span>
                    <i class="fab fa-brands fa-twitter fa-2x"></i>
                    
                </a>
                <a href="https://www.instagram.com/ilyass.drafts/" class="text-indigo-600 hover:text-indigo-500 transition-colors">
                    <span class="sr-only">LinkedIn</span>
                    <i class="fab fa-linkedin fa-2x"></i>
                </a>
            </div>
        </div>
    </section>
    <!-- Footer Component -->
    @include('components.footer')
</body>
</html>