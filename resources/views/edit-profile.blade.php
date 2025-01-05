<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen">

    <!-- Navbar -->
    <header class="fixed top-0 left-0 w-full z-50 bg-gradient-to-r from-purple-700 to-pink-500 text-white">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="text-white text-2xl font-bold flex flex-col leading-tight">
                <span>Panggung</span>
                <span class="text-pink-500 text-xl">NUSANTARA</span>
            </a>
            <div class="flex items-center space-x-6">
                <a href="/about" class="text-white hover:text-purple-900">About</a>
                <a href="/account" class="text-white hover:text-purple-900">My Account</a>
                @auth
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600">Logout</button>
                </form>
                @else
                <a href="/login" class="bg-pink-500 text-white px-4 py-2 rounded-full hover:bg-pink-600">Login</a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-16 mt-20">
        <h2 class="text-3xl font-bold text-center mb-6">Edit Profile</h2>
        <div class="mt-4">
            <!-- Avatar Image -->
            <img
                id="avatarPreview"
                src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('img/default-avatar.png') }}"
                alt="Avatar"
                class="h-32 w-32 rounded-full mx-auto border-2 border-gray-300 object-cover" />
        </div>
        <form id="editProfileForm" action="/update-profile" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md max-w-2xl mx-auto mt-6">
            @csrf
            <div class="mb-4">
                <label for="image" class="block font-medium text-gray-700 mb-2">Avatar:</label>
                <input
                    type="file"
                    id="image"
                    name="image"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md"
                    accept="image/*"
                    onchange="previewImage(event)">
            </div>
            <div class="mb-4">
                <label for="username" class="block font-medium text-gray-700 mb-2">Username:</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ Auth::user()->username }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md"
                    required>
            </div>
            <div class="mb-4">
                <label for="password" class="block font-medium text-gray-700 mb-2">New Password:</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md"
                    oninput="checkPasswordStrength()">
                <div class="w-full h-2 bg-gray-200 rounded-md mt-2">
                    <div id="passwordStrengthBar" class="h-full rounded-md"></div>
                </div>
                <p id="passwordStrengthText" class="text-sm mt-2"></p>
            </div>
            <button type="submit" id="saveButton"
                class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded-md">
                Save Changes
            </button>
        </form>

        <!-- Delete Account -->
        <div class="bg-red-50 p-6 mt-6 rounded-lg shadow-md max-w-2xl mx-auto">
            <h3 class="text-xl font-bold text-red-600 mb-4">Danger Zone</h3>
            <p class="text-gray-600 mb-4">Deleting your account will permanently remove all your data, including your
                transaction history.</p>
            <button onclick="confirmDeletion()"
                class="bg-red-500 hover:bg-red-600 text-white font-medium px-6 py-2 rounded-md w-full">
                Delete Account
            </button>
        </div>
    </div>

    <div id="successModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
            <h3 class="text-lg font-bold text-green-600 mb-4">Success</h3>
            <p class="text-gray-600 mb-4">Your profile has been successfully updated!</p>
            <button onclick="closeModal()"
                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">Close</button>
        </div>
    </div>

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

    <!-- Confirmation Dialog -->
    <div id="confirmationDialog" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
            <h3 class="text-lg font-bold text-red-600 mb-4">Confirm Account Deletion</h3>
            <p class="text-gray-600 mb-4">Are you sure you want to delete your account? This action cannot be undone and
                all your data will be permanently deleted.</p>
            <div class="flex justify-end space-x-4">
                <button onclick="closeDialog()"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400">Cancel</button>
                <form action="/delete-account" method="POST" id="deleteAccountForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                document.getElementById('avatarPreview').src = URL.createObjectURL(file);
            }
        });

        let passwordStrength = 0;

        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('passwordStrengthBar');
            const strengthText = document.getElementById('passwordStrengthText');

            passwordStrength = 0;

            // Check password strength
            if (password.length >= 8) passwordStrength += 1;
            if (/[A-Z]/.test(password)) passwordStrength += 1;
            if (/[0-9]/.test(password)) passwordStrength += 1;
            if (/[@$!%*?&#]/.test(password)) passwordStrength += 1;

            // Update the bar and text
            strengthBar.style.width = (passwordStrength / 4) * 100 + '%';
            switch (passwordStrength) {
                case 0:
                case 1:
                    strengthBar.style.backgroundColor = 'red';
                    strengthText.textContent = 'Weak';
                    strengthText.className = 'text-red-500';
                    break;
                case 2:
                    strengthBar.style.backgroundColor = 'orange';
                    strengthText.textContent = 'Moderate';
                    strengthText.className = 'text-orange-500';
                    break;
                case 3:
                case 4:
                    strengthBar.style.backgroundColor = 'green';
                    strengthText.textContent = 'Strong';
                    strengthText.className = 'text-green-500';
                    break;
            }
        }

        const form = document.getElementById('editProfileForm');
        const passwordInput = document.getElementById('password');

        form.addEventListener('submit', function(event) {
            // Periksa kekuatan password hanya jika ada input di field password
            if (passwordInput.value && passwordStrength < 2) {
                event.preventDefault(); // Cegah form dikirim
                alert('Password strength is weak. Please improve your password.');
            } else {
                document.getElementById('successModal').classList.remove('hidden');

                setTimeout(() => {
                    form.submit();
                }, 5000);
            }
        });


        function confirmDeletion() {
            document.getElementById('confirmationDialog').classList.remove('hidden');
        }

        function closeDialog() {
            document.getElementById('confirmationDialog').classList.add('hidden');
        }

        function previewImage(event) {
            const imageInput = event.target;
            const preview = document.getElementById('avatarPreview');

            if (imageInput.files && imageInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                };

                reader.readAsDataURL(imageInput.files[0]);
            }
        }

        function closeModal() {
            document.getElementById('successModal').classList.add('hidden');
        }
    </script>
</body>

</html>