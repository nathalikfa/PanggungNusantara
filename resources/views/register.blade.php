<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Panggung Nusantara</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen bg-gray-900 font-sans">

    <!-- Background Section -->
    <div class="relative h-full">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('img/login.jpg') }}" alt="Register Background" class="w-full h-full object-cover" />
        </div>

        <!-- Transparent Overlay -->
        <div class="absolute inset-0 bg-black opacity-50"></div>

        <!-- Register Card -->
        <div class="relative z-10 flex items-center justify-center h-full">
            <div class="bg-white rounded-lg shadow-lg p-8 md:w-1/3 w-full mx-4">
                <h2 class="text-2xl font-semibold text-gray-800 text-center mb-4">Join Us at</h2>
                <h1 class="text-3xl font-bold text-pink-600 text-center mb-6">Panggung Nusantara</h1>

                <!-- Notification Section -->
                <div id="successNotification" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    Registration successful! Redirecting to login...
                </div>

                <!-- Notification Section -->
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('error') }}
                </div>
                @endif

                @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                <!-- Register Form -->
                <form action="{{ url('/register') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <!-- Username -->
                        <div class="relative">
                            <input type="text" name="username" placeholder="Username" required class="w-full px-4 py-2 bg-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                        </div>

                        <!-- Phone Number -->
                        <div class="relative">
                            <input type="tel" name="phone_number" placeholder="Phone Number" required class="w-full px-4 py-2 bg-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                        </div>

                        <!-- Password -->
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Password" required
                                class="w-full px-4 py-2 bg-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"
                                oninput="checkPasswordStrength()">
                            <div class="w-full h-2 bg-gray-200 rounded-md mt-2">
                                <div id="passwordStrengthBar" class="h-full rounded-md"></div>
                            </div>
                            <p id="passwordStrengthText" class="text-sm mt-2"></p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-blue-500">
                            <span class="ml-2 text-gray-600">Agree to terms</span>
                        </label>
                        <a href="/login" class="text-blue-600 hover:underline text-sm">Already have an account?</a>
                    </div>

                    <button type="submit" id="registerButton"
                        class="w-full mt-6 bg-pink-600 text-white py-2 rounded-lg shadow-lg hover:bg-pink-700">Register</button>
                </form>

                <!-- Footer -->
                <div class="text-center mt-6">
                    <p class="text-sm text-gray-500">
                        By registering, you agree to our <a href="#" class="text-blue-600 hover:underline">Terms</a> and
                        <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>


    <script>
        let passwordStrength = 0;

        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('passwordStrengthBar');
            const strengthText = document.getElementById('passwordStrengthText');

            passwordStrength = 0;

            // Evaluate password strength
            if (password.length >= 8) passwordStrength += 1; // Minimum length
            if (/[A-Z]/.test(password)) passwordStrength += 1; // Uppercase
            if (/[0-9]/.test(password)) passwordStrength += 1; // Number
            if (/[@$!%*?&#]/.test(password)) passwordStrength += 1; // Special character

            // Update the progress bar and text
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

        // Prevent submission if password is weak
        const form = document.querySelector('form');
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent immediate form submission

            if (passwordStrength < 2) {
                alert('Password strength is weak. Please improve your password.');
            } else {
                // Show success notification
                const notification = document.getElementById('successNotification');
                notification.classList.remove('hidden');

                // Delay form submission
                setTimeout(() => {
                    form.submit();
                }, 2000); // 3-second delay
            }
        });
    </script>

</body>

</html>