<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Panggung Nusantara</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased bg-gray-100">

    <!-- Navbar -->
    <header id="navbar" class="absolute top-0 left-0 w-full z-50 bg-gradient-to-r from-purple-700 to-pink-500 text-white">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="text-white text-2xl font-bold flex flex-col leading-tight">
                <span>Panggung</span>
                <span class="text-pink-500 text-xl">NUSANTARA</span>
            </a>

            <div class="relative w-1/3">
                <input
                    type="text"
                    placeholder="Search an artist"
                    class="w-full py-2 pl-10 pr-4 bg-white rounded-full text-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-500" />
                <div class="absolute left-3 top-2.5 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16.7 10.85a6 6 0 11-8.49-8.49 6 6 0 018.49 8.49z" />
                    </svg>
                </div>
            </div>

            <!-- Navbar Links -->
            <div class="flex items-center space-x-6">
                <a href="/about" class="text-white hover:text-pink-500">About</a>
                <a href="/account" class="text-white hover:text-pink-500">My Account</a>

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

    <!-- Payment Section -->
    <section class="py-20 mt-9">
        <div class="container mx-auto px-6 space-y-4">
            <!-- Ticket Details -->
            <div class="bg-white p-4 shadow-lg flex items-center space-x-2">
                <!-- Image Section -->
                <div class="flex-shrink-0">
                    <img src="{{ $concert->artist->image }}" alt="{{ $concert->artist->name }}" class="w-20 h-20 object-cover">
                </div>
                <!-- Text Details -->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 flex items-center space-x-2">
                        <span>{{ $concert->artist->name }}</span>
                        @if(\Carbon\Carbon::parse($concert->date)->isTomorrow())
                        <span class="bg-pink-500 text-white text-xs font-semibold px-2 py-1">Tomorrow</span>
                        @endif
                    </h3>
                    <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($concert->date)->format('M d • l • Y') }}</p>
                    <p class="text-sm text-blue-500 hover:underline">
                        <a href="#">{{ $concert->location }}</a>
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Stage Image -->
                <div>
                    <img src="/img/plot.jpg" alt="Stage Layout" class="w-full shadow-lg">
                </div>

                <!-- Registration Form -->
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Enter Details</h2>
                    <form id="paymentForm" action="/payment/confirm" method="POST" class="bg-white p-6 shadow-lg">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="seat_type" name="seat_type">
                        <input type="hidden" id="price" name="price">
                        <input type="hidden" id="payment_method" name="payment_method">
                        <input type="hidden" id="bank" name="bank">
                        @if($concert)
                        <input type="hidden" name="concert_id" value="{{ $concert->id }}">
                        @else
                        <p class="text-red-500">Concert data is missing!</p>
                        @endif

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                            <input type="text" id="email" name="email" required
                                class="w-full border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">
                        </div>

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-medium mb-2">Full Name</label>
                            <input type="text" id="name" name="name" required
                                class="w-full border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone" required
                                class="w-full border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="block text-gray-700 font-medium mb-2">Number of Tickets</label>
                            <input type="number" id="quantity" name="quantity" min="1" max="10" required value="1"
                                class="w-full border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Select Seat</label>
                            <div class="grid grid-cols-2 gap-4">
                                @forelse ($seats as $seat)
                                <div id="seat-{{ strtolower(str_replace(' ', '-', $seat->type)) }}"
                                    class="seat-option border border-gray-300 px-4 py-3 text-center cursor-pointer"
                                    onclick="selectSeat('{{ $seat->type }}', '{{ $seat->price }}')">
                                    <p class="font-bold text-gray-800">{{ $seat->type }}</p>
                                    <p class="text-sm text-gray-600">Rp. {{ number_format($seat->price, 2, ',', '.') }}</p>
                                </div>
                                @empty
                                <p class="text-gray-600">No seats available for this concert.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Payment Method</label>
                            <div class="grid grid-cols-2 gap-4">
                                <div id="option-gopay" class="payment-option cursor-pointer flex flex-col items-center p-4 border rounded-lg hover:border-pink-500"
                                    onclick="selectPaymentMethod('Gopay')">
                                    <img src="/img/gopay.png" alt="Gopay" class="w-24 h-24 object-contain mt-5">
                                </div>
                                <div id="option-ovo" class="payment-option cursor-pointer flex flex-col items-center p-4 border rounded-lg hover:border-pink-500"
                                    onclick="selectPaymentMethod('Ovo')">
                                    <img src="/img/ovo.png" alt="Ovo" class="w-24 h-24 object-contain mt-4">
                                </div>
                                <div id="option-paypal" class="payment-option cursor-pointer flex flex-col items-center p-4 border rounded-lg hover:border-pink-500"
                                    onclick="selectPaymentMethod('Paypal')">
                                    <img src="/img/paypal.png" alt="Paypal" class="w-24 h-24 object-contain">
                                </div>
                                <div id="option-bank" class="payment-option cursor-pointer flex flex-col items-center p-4 border rounded-lg hover:border-pink-500"
                                    onclick="selectPaymentMethod('Bank')">
                                    <img src="/img/bank.png" alt="Bank Transfer" class="w-24 h-24 object-contain">
                                </div>
                            </div>
                        </div>

                        <!-- Bank Options -->
                        <div id="bankOptions" class="hidden">
                            <label class="block text-gray-700 font-medium mb-2">Select Bank</label>
                            <div class="grid grid-cols-3 gap-4">
                                <div id="bank-bri" class="bank-option cursor-pointer flex flex-col items-center p-4 border rounded-lg hover:border-pink-500"
                                    onclick="selectBank('BRI')">
                                    <img src="/img/bni.png" alt="BRI" class="w-16 h-16 object-contain">
                                </div>
                                <div id="bank-bca" class="bank-option cursor-pointer flex flex-col items-center p-4 border rounded-lg hover:border-pink-500"
                                    onclick="selectBank('BCA')">
                                    <img src="/img/bca.png" alt="BCA" class="w-16 h-16 object-contain">
                                </div>
                                <div id="bank-mandiri" class="bank-option cursor-pointer flex flex-col items-center p-4 border rounded-lg hover:border-pink-500"
                                    onclick="selectBank('Mandiri')">
                                    <img src="/img/mandiri.png" alt="Mandiri" class="w-16 h-16 object-contain">
                                </div>
                            </div>
                        </div>

                        <!-- Total Price -->
                        <div class="mb-6">
                            <p class="text-lg font-bold text-gray-800 mt-10">Total Price: <span id="totalPrice">Rp. 0</span></p>
                        </div>

                        <button type="submit"
                            class="w-full bg-pink-500 text-white px-6 py-3 font-bold hover:bg-pink-600 focus:outline-none focus:ring-4 focus:ring-pink-300">
                            Proceed Payment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer Section -->
    <footer id="footer" class="bg-purple-950 text-white py-12">
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
        const proceedButton = document.getElementById('proceedButton');
        const footer = document.getElementById('footer');
        const navbar = document.getElementById('navbar');
        const bankOptions = document.getElementById('bankOptions');
        const form = document.getElementById('paymentForm');
        const paymentError = document.getElementById('paymentError');

        let selectedMethod = null;
        let selectedBank = null;
        let selectedSeat = null;
        let selectedPrice = 0;

        function selectSeat(type, price) {
            // Reset semua highlight
            document.querySelectorAll('.seat-option').forEach(option => {
                option.classList.remove('border-pink-500');
                option.classList.add('border-gray-300');
            });

            // Ubah border elemen yang dipilih
            const seatId = `seat-${type.toLowerCase().replace(' ', '-')}`;
            const selectedElement = document.getElementById(seatId);
            if (selectedElement) {
                selectedElement.classList.add('border-pink-500');
                selectedElement.classList.remove('border-gray-300');
            } else {
                alert('Error: Selected seat not found');
                return;
            }

            // Simpan kursi yang dipilih
            selectedSeat = type;
            selectedPrice = price;

            // Masukkan nilai ke input hidden
            document.getElementById('seat_type').value = type;
            document.getElementById('price').value = price;

            // Perbarui total harga
            updateTotalPrice();
        }


        function updateTotalPrice() {
            const quantityElement = document.getElementById('quantity');
            const quantity = quantityElement ? parseInt(quantityElement.value) || 1 : 1;

            const totalPrice = selectedPrice * quantity;
            const totalPriceElement = document.getElementById('totalPrice');

            if (totalPriceElement) {
                totalPriceElement.textContent = `Rp. ${totalPrice.toLocaleString()}`;
            } else {
                console.error('Error: Total price element not found.');
            }

            console.log('Quantity:', quantity);
            console.log('Total Price:', totalPrice);
        }

        form.addEventListener('submit', (event) => {
            const seatType = document.getElementById('seat_type').value;
            const paymentMethod = document.getElementById('payment_method').value;

            if (!seatType || !paymentMethod) {
                event.preventDefault();
                alert('Please select a seat and payment method before proceeding.');
            } else {
                console.log('Form is ready to submit');
                console.log('Seat Type:', seatType);
                console.log('Price:', selectedPrice);
                console.log('Payment Method:', paymentMethod);
            }
        });


        // Select Payment Method
        function selectPaymentMethod(method) {
            document.querySelectorAll('.payment-option').forEach(option => option.classList.remove('border-pink-500'));
            document.getElementById(`option-${method.toLowerCase()}`).classList.add('border-pink-500');

            selectedMethod = method;

            // Masukkan nilai ke input hidden
            document.getElementById('payment_method').value = method;

            if (method === 'Bank') {
                document.getElementById('bankOptions').classList.remove('hidden');
            } else {
                document.getElementById('bankOptions').classList.add('hidden');
                document.getElementById('bank').value = '';
            }
        }


        // Select Bank
        function selectBank(bank) {
            document.querySelectorAll('.bank-option').forEach(option => option.classList.remove('border-pink-500'));
            document.getElementById(`bank-${bank.toLowerCase()}`).classList.add('border-pink-500');

            selectedBank = bank;

            // Masukkan nilai ke input hidden
            document.getElementById('bank').value = bank;
        }


        function generateTicketCode() {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let code = '';
            for (let i = 0; i < 8; i++) {
                code += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return code;
        }

        // Handle Payment Method Change
        function handlePaymentChange(method) {
            if (method === 'Bank') {
                bankOptions.classList.remove('hidden');
            } else {
                bankOptions.classList.add('hidden');
            }
        }
    </script>
</body>

</html>