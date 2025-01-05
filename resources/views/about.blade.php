<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Panggung Nusantara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Function to animate counting
        function animateCount(element, targetNumber, duration) {
            let currentNumber = 0;
            const step = Math.ceil(targetNumber / (duration / 30));
            const interval = setInterval(() => {
                currentNumber += step;
                if (currentNumber >= targetNumber) {
                    currentNumber = targetNumber; // Set the final number
                    clearInterval(interval); // Stop the interval
                    element.textContent = currentNumber + "+"; // Append '+' to the final number
                } else {
                    element.textContent = currentNumber; // Update the number during animation
                }
            }, 30);
        }


        // Initialize counters after page load
        window.onload = function() {
            const highlights = [{
                    selector: "#ticketsSold",
                    target: 100000
                },
                {
                    selector: "#eventsHosted",
                    target: 500
                },
                {
                    selector: "#yearsExcellence",
                    target: 5
                },
            ];

            highlights.forEach((highlight) => {
                const element = document.querySelector(highlight.selector);
                animateCount(element, highlight.target, 2000); // Animate over 2 seconds
            });
        };
    </script>
</head>

<body class="font-sans antialiased bg-gray-100">

    <!-- Navbar -->
    <header class="absolute top-0 left-0 w-full z-50 bg-gradient-to-r from-purple-700 to-pink-500 text-white">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="text-white text-2xl font-bold flex flex-col leading-tight">
                <span>Panggung</span>
                <span class="text-pink-500 text-xl">NUSANTARA</span>
            </a>

            <!-- Search Field -->
            <div class="relative w-1/3">
                <input
                    type="text"
                    id="search-input"
                    placeholder="Search an artist"
                    class="w-full py-2 pl-10 pr-4 bg-white rounded-full text-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-500" />
                <div id="search-results" class="absolute top-full left-0 w-full bg-white border border-gray-200 rounded-lg shadow-lg hidden">
                    <!-- Search results will be dynamically inserted here -->
                </div>
                <div class="absolute left-3 top-2.5 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16.7 10.85a6 6 0 11-8.49-8.49 6 6 0 018.49 8.49z" />
                    </svg>
                </div>
            </div>

            <!-- Navbar Links -->
            <div class="flex items-center space-x-6">
                <a href="/about" class="text-white hover:text-purple-900">About</a>
                <a href="/account" class="text-white hover:text-purple-900">My Account</a>

                @auth
                <div class="relative">
                    <div
                        id="userMenuButton"
                        class="bg-purple-600 text-white px-4 py-2 rounded-full">
                        <span>Hello, {{ Auth::user()->username }}</span>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
                @else
                <!-- Show login button when not authenticated -->
                <a href="/login" class="bg-pink-500 text-white px-4 py-2 rounded-full hover:bg-pink-600">Login</a>
                @endauth
            </div>

        </nav>
    </header>

    <!-- Header Section -->
    <header class="bg-gradient-to-r from-purple-700 to-pink-500 text-white py-20 mt-16">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-6xl font-bold mb-4">INTRODUCE</h1>
            <p class="text-lg">Indonesia's trusted platform for concert tickets<br> Discover top music events with ease and convenience!</p>
        </div>
    </header>

    <!-- Highlight Section -->
    <section class="bg-white py-16 shadow-lg">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <!-- Highlight 1 -->
            <div class="p-6 bg-gray-50 rounded-lg shadow hover:shadow-lg">
                <h2 class="text-5xl font-bold text-pink-500" id="ticketsSold">0</h2>
                <p class="mt-2 text-gray-600">Tickets Sold</p>
                <p class="mt-4 text-sm text-gray-500">Trusted by over a thousand customers across Indonesia.</p>
            </div>

            <!-- Highlight 2 -->
            <div class="p-6 bg-gray-50 rounded-lg shadow hover:shadow-lg">
                <h2 class="text-5xl font-bold text-purple-500" id="eventsHosted">0</h2>
                <p class="mt-2 text-gray-600">Events Hosted</p>
                <p class="mt-4 text-sm text-gray-500">From intimate gigs to large-scale concerts.</p>
            </div>

            <!-- Highlight 3 -->
            <div class="p-6 bg-gray-50 rounded-lg shadow hover:shadow-lg">
                <h2 class="text-5xl font-bold text-blue-500" id="yearsExcellence">0</h2>
                <p class="mt-2 text-gray-600"> Years of Excellence</p>
                <p class="mt-4 text-sm text-gray-500">Delivering seamless ticketing experiences.</p>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-700 to-pink-500 mb-12 py-4">Why Choose Panggung Nusantara?</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1: User-Friendly -->
                <div class="bg-white rounded-lg p-6 shadow hover:shadow-lg">
                    <div class="mb-4">
                        <img src="{{ asset('img/icon1.png') }}" alt="User-Friendly Icon" class="w-10 h-10 mx-auto">
                    </div>
                    <h3 class="text-xl font-bold text-gray-700">User-Friendly</h3>
                    <p class="text-sm text-gray-500 mt-4">Experience an easy-to-use platform for all your concert ticket needs.</p>
                </div>

                <!-- Feature 2: Secure Payment -->
                <div class="bg-white rounded-lg p-6 shadow hover:shadow-lg">
                    <div class="mb-4">
                        <img src="{{ asset('img/icon2.png') }}" alt="Secure Payment Icon" class="w-10 h-10 mx-auto">
                    </div>
                    <h3 class="text-xl font-bold text-gray-700">Secure Payment</h3>
                    <p class="text-sm text-gray-500 mt-4">Multiple payment methods with the highest security standards.</p>
                </div>

                <!-- Feature 3: Verified Events -->
                <div class="bg-white rounded-lg p-6 shadow hover:shadow-lg">
                    <div class="mb-4">
                        <img src="{{ asset('img/icon3.png') }}" alt="Verified Events Icon" class="w-10 h-10 mx-auto">
                    </div>
                    <h3 class="text-xl font-bold text-gray-700">Verified Events</h3>
                    <p class="text-sm text-gray-500 mt-4">Only trusted and verified events for your peace of mind.</p>
                </div>

                <!-- Feature 4: Customer Support -->
                <div class="bg-white rounded-lg p-6 shadow hover:shadow-lg">
                    <div class="mb-4">
                        <img src="{{ asset('img/icon4.png') }}" alt="Customer Support Icon" class="w-10 h-10 mx-auto">
                    </div>
                    <h3 class="text-xl font-bold text-gray-700">Customer Support</h3>
                    <p class="text-sm text-gray-500 mt-4">Get fast and reliable support whenever you need it.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Payment Partners Section -->
    <section class="bg-gray-50 py-16">
        <div class="container mx-auto px-6 text-center">
            <!-- Section Title with Gradient -->
            <h2 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-700 to-pink-500 mb-8 py-4">
                Support Payment Methods
            </h2>
            <p class="text-gray-600 mb-12">
                We collaborate with trusted banks and payment partners to ensure secure and seamless transactions.
            </p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center justify-center">
                <!-- Logo 1 -->
                <div class="flex items-center justify-center">
                    <img src="/img/bca1.png" alt="BCA" class="h-60 w-auto object-contain">
                </div>
                <!-- Logo 2 -->
                <div class="flex items-center justify-center">
                    <img src="/img/mandiri.png" alt="Mandiri" class="h-44 w-auto object-contain">
                </div>
                <!-- Logo 3 -->
                <div class="flex items-center justify-center">
                    <img src="/img/bni.png" alt="BNI" class="h-12 w-auto object-contain">
                </div>
                <!-- Logo 4 -->
                <div class="flex items-center justify-center">
                    <img src="/img/ovo.png" alt="OVO" class="h-20 w-auto object-contain">
                </div>
                <!-- Logo 5 -->
                <div class="flex items-center justify-center">
                    <img src="/img/gopay.png" alt="Gopay" class="h-12 w-auto object-contain">
                </div>
                <!-- Logo 6 -->
                <div class="flex items-center justify-center">
                    <img src="/img/dana.png" alt="Dana" class="h-44 w-auto object-contain">
                </div>
                <!-- Logo 7 -->
                <div class="flex items-center justify-center">
                    <img src="/img/link.png" alt="LinkAja" class="h-14 w-auto object-contain">
                </div>
                <!-- Logo 8 -->
                <div class="flex items-center justify-center">
                    <img src="/img/paypal.png" alt="PayPal" class="h-48 w-auto object-contain">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-purple-950 text-white py-12">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo and Description -->
            <div>
                <h2 class="text-2xl font-bold mb-4">Panggung<span class="text-pink-500">Nusantara</span></h2>
                <p class="text-sm text-gray-300 mb-4">
                    Eventick is a global self-service ticketing platform for live experiences that allows anyone to create,
                    share, find, and attend events that fuel their passions and enrich their lives.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-white hover:text-pink-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22.675 0h-21.35c-.733 0-1.325.592-1.325 1.325v21.35c0 .733.592 1.325 1.325 1.325h21.35c.733 0 1.325-.592 1.325-1.325v-21.35c0-.733-.592-1.325-1.325-1.325zm-12.898 18.893h-2.808v-8.409h2.808v8.409zm-1.404-9.539c-.903 0-1.634-.731-1.634-1.634s.731-1.634 1.634-1.634c.903 0 1.634.731 1.634 1.634s-.731 1.634-1.634 1.634zm11.088 9.539h-2.808v-4.218c0-1.005-.02-2.296-1.398-2.296-1.398 0-1.614 1.092-1.614 2.22v4.294h-2.808v-8.409h2.695v1.147h.038c.376-.713 1.292-1.464 2.658-1.464 2.842 0 3.366 1.869 3.366 4.299v4.427z" />
                        </svg>
                    </a>
                    <a href="#" class="text-white hover:text-pink-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.016-.609 1.798-1.574 2.165-2.723-.949.564-2.005.974-3.127 1.194-.896-.955-2.173-1.554-3.591-1.554-2.717 0-4.92 2.203-4.92 4.917 0 .386.043.762.127 1.124-4.087-.205-7.713-2.162-10.141-5.134-.423.725-.666 1.562-.666 2.457 0 1.695.864 3.191 2.178 4.066-.802-.026-1.558-.246-2.215-.616v.062c0 2.367 1.684 4.342 3.918 4.79-.41.112-.844.171-1.291.171-.316 0-.623-.031-.923-.088.623 1.946 2.432 3.364 4.576 3.403-1.675 1.313-3.785 2.095-6.076 2.095-.394 0-.785-.023-1.17-.068 2.166 1.39 4.737 2.201 7.507 2.201 9.007 0 13.928-7.457 13.928-13.926 0-.213-.005-.425-.014-.637.957-.692 1.785-1.56 2.437-2.548l-.047-.02z" />
                        </svg>
                    </a>
                    <a href="#" class="text-white hover:text-pink-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c-5.488 0-9.918 4.429-9.918 9.917 0 4.386 3.555 8.034 8.168 9.792-.113-.826-.215-2.09.043-2.988.23-.84 1.484-5.336 1.484-5.336s-.378-.756-.378-1.87c0-1.751 1.016-3.057 2.278-3.057 1.074 0 1.59.806 1.59 1.77 0 1.078-.684 2.693-1.036 4.187-.294 1.236.626 2.242 1.855 2.242 2.228 0 3.935-2.344 3.935-5.72 0-2.987-2.147-5.063-5.217-5.063-3.561 0-5.657 2.67-5.657 5.424 0 1.077.411 2.232.926 2.861.104.127.119.238.088.37-.099.407-.328 1.29-.371 1.47-.054.22-.176.268-.406.162-1.53-.71-2.482-2.935-2.482-4.718 0-3.843 2.802-7.384 8.088-7.384 4.244 0 7.538 3.018 7.538 7.045 0 4.207-2.654 7.588-6.328 7.588-1.234 0-2.396-.642-2.793-1.397l-.759 2.883c-.274 1.044-1.019 2.357-1.527 3.16 1.148.344 2.362.531 3.621.531 5.487 0 9.918-4.43 9.918-9.917 0-5.488-4.431-9.917-9.918-9.917z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Plan Events -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Plan Events</h3>
                <ul class="text-sm text-gray-300 space-y-2">
                    <li><a href="#" class="hover:text-pink-500">Create and Set Up</a></li>
                    <li><a href="#" class="hover:text-pink-500">Sell Tickets</a></li>
                    <li><a href="#" class="hover:text-pink-500">Online RSVP</a></li>
                    <li><a href="#" class="hover:text-pink-500">Online Events</a></li>
                </ul>
            </div>

            <!-- Eventick -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Panggung Nusantara</h3>
                <ul class="text-sm text-gray-300 space-y-2">
                    <li><a href="#" class="hover:text-pink-500">About Us</a></li>
                    <li><a href="#" class="hover:text-pink-500">Press</a></li>
                    <li><a href="#" class="hover:text-pink-500">Contact Us</a></li>
                    <li><a href="#" class="hover:text-pink-500">Help Center</a></li>
                    <li><a href="#" class="hover:text-pink-500">How It Works</a></li>
                    <li><a href="#" class="hover:text-pink-500">Privacy</a></li>
                    <li><a href="#" class="hover:text-pink-500">Terms</a></li>
                </ul>
            </div>

            <!-- Subscribe -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Stay In The Loop</h3>
                <p class="text-sm text-gray-300 mb-4">Join our mailing list to stay in the loop with our newest events and concerts.</p>

            </div>
        </div>

        <hr class="border-gray-700 my-8">

        <!-- Footer Bottom -->
        <div class="text-center text-sm text-gray-300">
            Copyright © 2025 Panggung Nusantara
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('search-input');
            const searchResults = document.getElementById('search-results');

            searchInput.addEventListener('input', async () => {
                const query = searchInput.value.trim();
                if (query.length > 0) {
                    try {
                        const response = await fetch(`/search?query=${query}`);
                        const artists = await response.json();

                        // Clear previous results
                        searchResults.innerHTML = '';

                        if (artists.length > 0) {
                            artists.forEach(artist => {
                                const resultItem = document.createElement('div');
                                resultItem.classList.add('flex', 'items-center', 'p-2', 'cursor-pointer');
                                resultItem.innerHTML = `
                                <img src="${artist.image || '/img/default_artist.jpg'}" alt="${artist.name}" class="w-12 h-12 object-cover rounded-full mr-3">
                                <span class="text-gray-800">${artist.name}</span>
                            `;
                                resultItem.addEventListener('click', () => {
                                    window.location.href = `/artist/${artist.id}`;
                                });

                                searchResults.appendChild(resultItem);
                            });
                            searchResults.classList.remove('hidden');
                        } else {
                            searchResults.innerHTML = '<p class="p-2 text-gray-600">No artists found</p>';
                            searchResults.classList.remove('hidden');
                        }
                    } catch (error) {
                        console.error('Error fetching search results:', error);
                    }
                } else {
                    searchResults.innerHTML = '';
                    searchResults.classList.add('hidden');
                }
            });

            // Hide results when clicking outside
            document.addEventListener('click', (event) => {
                if (!searchResults.contains(event.target) && event.target !== searchInput) {
                    searchResults.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>