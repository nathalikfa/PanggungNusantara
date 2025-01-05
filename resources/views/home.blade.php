<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Panggung Nusantara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Hide scrollbar for modern browsers */
        .hide-scrollbar {
            scrollbar-width: none;
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .active-bullet {
            background-color: #ec4899;
            /* Tailwind pink-500 */
        }
    </style>
</head>

<body class="font-sans antialiased">

    <!-- Header -->
    <header class="absolute top-0 left-0 w-full z-50">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="#" class="text-white text-2xl font-bold flex flex-col leading-tight">
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


            <!-- Menu & Button -->
            <div class="flex items-center space-x-6">
                <a href="/about" class="text-white hover:text-pink-500">About</a>
                <a href="/account" class="text-white hover:text-pink-500">My Account</a>

                @auth
                <div class="relative">
                    <div
                        id="userMenuButton"
                        class="bg-pink-500 text-white px-4 py-2 rounded-full">
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

    <!-- Hero Section -->
    <section class="relative h-screen">
        <div class="absolute inset-0">
            <img src="{{ asset('img/home.jpg') }}" alt="Event" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-500 opacity-30"></div>
            <div class="absolute inset-0 bg-black opacity-30"></div>
        </div>


        <!-- Content -->
        <div class="relative z-10 flex items-center h-full">
            <div class="container mx-auto px-6">
                <div class="w-full md:w-1/2">
                    <h1 class="text-5xl font-bold text-white leading-tight mb-4">
                        Welcome to <br> <span class="text-pink-500">Panggung Nusantara</span>
                    </h1>
                    <p class="text-white text-lg mb-8">
                        Your ultimate platform for booking concert tickets and live music shows in Indonesia.
                    </p>
                    <div class="space-x-4">
                        <a href="/about" class="border-2 border-white text-white px-6 py-3 rounded-full hover:bg-white hover:text-pink-500">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Upcoming Events Section -->
    <section class="bg-gray-50 py-16">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Upcoming Events</h2>
                <p class="text-gray-600">Discover events happening around the world</p>
            </div>

            <!-- Events Slider -->
            <div class="relative">
                <div id="slider" class="flex space-x-4 overflow-x-scroll hide-scrollbar scroll-smooth">
                    <!-- Event Cards -->
                    <div class="bg-white rounded-lg shadow overflow-hidden w-72 shrink-0">
                        <img src="{{ asset('img/sheilla_cover.jpg') }}" alt="Event 1" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <p class="text-sm text-gray-500">APR 1</p>
                            <h3 class="text-lg font-bold text-gray-800">Sheila on 7</h3>
                            <p class="text-sm text-gray-600">Get your tickets before they run out. Don't miss the opportunity to meet your favorite artist!</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow overflow-hidden w-72 shrink-0">
                        <img src="{{ asset('img/feast_cover.jpg') }}" alt="Event 2" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <p class="text-sm text-gray-500">APR 2</p>
                            <h3 class="text-lg font-bold text-gray-800">Efek Rumah Kaca</h3>
                            <p class="text-sm text-gray-600">Get your tickets before they run out. Don't miss the opportunity to meet your favorite artist!</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow overflow-hidden w-72 shrink-0">
                        <img src="{{ asset('img/panturas_cover.jpeg') }}" alt="Event 3" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <p class="text-sm text-gray-500">MAY 10</p>
                            <h3 class="text-lg font-bold text-gray-800">The Panturas</h3>
                            <p class="text-sm text-gray-600">Get your tickets before they run out. Don't miss the opportunity to meet your favorite artist!</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow overflow-hidden w-72 shrink-0">
                        <img src="{{ asset('img/endah_cover.jpg') }}" alt="Event 3" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <p class="text-sm text-gray-500">JUN 14</p>
                            <h3 class="text-lg font-bold text-gray-800">Endah N Rhesa</h3>
                            <p class="text-sm text-gray-600">Get your tickets before they run out. Don't miss the opportunity to meet your favorite artist!</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow overflow-hidden w-72 shrink-0">
                        <img src="{{ asset('img/nidji_cover.jpeg') }}" alt="Event 3" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <p class="text-sm text-gray-500">JUL 10</p>
                            <h3 class="text-lg font-bold text-gray-800">Nidji</h3>
                            <p class="text-sm text-gray-600">Get your tickets before they run out. Don't miss the opportunity to meet your favorite artist!</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow overflow-hidden w-72 shrink-0">
                        <img src="{{ asset('img/vierra_cover.jpg') }}" alt="Event 3" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <p class="text-sm text-gray-500">JUL 24</p>
                            <h3 class="text-lg font-bold text-gray-800">Vierra</h3>
                            <p class="text-sm text-gray-600">Get your tickets before they run out. Don't miss the opportunity to meet your favorite artist!</p>
                        </div>
                    </div>
                </div>

                <!-- Pagination Bullets -->
                <div class="flex justify-center mt-6 space-x-2">
                    <button class="bullet w-3 h-3 bg-gray-300 rounded-full focus:outline-none"></button>
                    <button class="bullet w-3 h-3 bg-gray-300 rounded-full focus:outline-none"></button>
                    <button class="bullet w-3 h-3 bg-gray-300 rounded-full focus:outline-none"></button>
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
        const slider = document.getElementById('slider');
        const bullets = document.querySelectorAll('.bullet');
        let currentIndex = 0;

        function updateActiveBullet() {
            bullets.forEach((bullet, index) => {
                bullet.classList.toggle('bg-pink-500', index === currentIndex);
                bullet.classList.toggle('bg-gray-300', index !== currentIndex);
            });
        }

        function scrollToSlide(index) {
            const cardWidth = document.querySelector('.w-72').offsetWidth;
            slider.scrollTo({
                left: (cardWidth + 16) * index, // Includes gap of 16px
                behavior: 'smooth',
            });
            currentIndex = index;
            updateActiveBullet();
        }

        // Auto-scroll every 3 seconds
        setInterval(() => {
            currentIndex = (currentIndex + 1) % bullets.length;
            scrollToSlide(currentIndex);
        }, 3000);

        // Update bullets when clicked
        bullets.forEach((bullet, index) => {
            bullet.addEventListener('click', () => {
                scrollToSlide(index);
            });
        });

        // Initialize the first active bullet
        updateActiveBullet();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('search-input');
            const searchResults = document.getElementById('search-results');
            let isDataLoaded = false; // Flag to check if data is already loaded

            // Fetch artist data on input focus
            async function fetchArtists() {
                if (isDataLoaded) return; // Prevent multiple requests if already loaded

                try {
                    const response = await fetch('/search/all-artists');
                    const artists = await response.json();

                    // Populate the dropdown
                    displayArtists(artists);
                    isDataLoaded = true; // Set flag to true after data is loaded
                } catch (error) {
                    console.error('Error fetching artists:', error);
                }
            }

            // Display artist results
            function displayArtists(artists) {
                searchResults.innerHTML = ''; // Clear existing results
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
            }

            // Show dropdown and fetch data on input focus
            searchInput.addEventListener('focus', () => {
                searchResults.classList.remove('hidden');
                fetchArtists(); // Fetch data only when input is focused
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