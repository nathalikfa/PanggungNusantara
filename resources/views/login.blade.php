<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Panggung Nusantara</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen bg-gray-900 font-sans">

    <!-- Background Section -->
    <div class="relative h-full">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('img/login.jpg') }}" alt="Login Background" class="w-full h-full object-cover" />
        </div>

        <!-- Transparent Overlay -->
        <div class="absolute inset-0 bg-black opacity-50"></div>

        <!-- Login Card -->
        <div class="relative z-10 flex items-center justify-center h-full">
            <div class="bg-white rounded-lg shadow-lg p-8 md:w-1/3 w-full mx-4">
                <h2 class="text-2xl font-semibold text-gray-800 text-center mb-4">Welcome to</h2>
                <h1 class="text-3xl font-bold text-pink-600 text-center mb-6">Panggung Nusantara</h1>

                <!-- Social Login -->
                <div class="space-y-4">
                    <button
                        class="w-full flex items-center justify-center space-x-3 px-4 py-2 bg-gray-100 rounded-lg shadow hover:bg-gray-200">
                        <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google Logo"
                            class="h-6">
                        <span class="text-gray-700">Login with Google</span>
                    </button>
                    <button
                        class="w-full flex items-center justify-center space-x-3 px-4 py-2 bg-purple-600 rounded-lg shadow hover:bg-purple-900 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="h-6 w-6 fill-white">
                            <path fill="#FFFFFF"
                                d="M24 4C12.95 4 4 12.95 4 24c0 9.88 7.19 18.07 16.44 19.72v-13.9H16v-5.82h4.44v-3.53c0-4.38 2.61-6.77 6.6-6.77 1.91 0 3.91.34 3.91.34v4.29H27.7c-1.88 0-2.46 1.16-2.46 2.35v2.82h4.66l-.75 5.82h-3.91v13.9C36.81 42.07 44 33.88 44 24 44 12.95 35.05 4 24 4z" />
                        </svg>
                        <span class="text-white font-medium">Login with Facebook</span>
                    </button>

                </div>

                <!-- Separator -->
                <div class="flex items-center my-6">
                    <hr class="flex-grow border-gray-300">
                    <span class="px-4 text-gray-500">OR</span>
                    <hr class="flex-grow border-gray-300">
                </div>

                @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 text-center rounded relative mb-4">
                    {{ session('error') }}
                </div>
                @endif

                <!-- Login Form -->
                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div class="relative">
                            <input type="username" name="username" placeholder="Username" class="w-full px-4 py-2 bg-gray-100 rounded-lg">
                            <div class="absolute left-3 top-2.5 text-gray-400">
                            </div>
                        </div>
                        <div class="relative">
                            <input type="password" name="password" placeholder="Password" class="w-full px-4 py-2 bg-gray-100 rounded-lg">
                            <div class="absolute right-3 top-2.5 text-gray-400 cursor-pointer">

                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-blue-500">
                            <span class="ml-2 text-gray-600">Remember me</span>
                        </label>
                        <a href="#" class="text-blue-600 hover:underline text-sm">Forgot Password?</a>
                    </div>

                    <button
                        class="w-full mt-6 bg-pink-600 text-white py-2 rounded-lg shadow-lg hover:bg-pink-700">Login</button>
                </form>

                <!-- Footer -->
                <div class="text-center mt-6">
                    <p class="text-sm text-gray-500">
                        Don't have an account? <a href="/register" class="text-blue-600 hover:underline">Register</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>