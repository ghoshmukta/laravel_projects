<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    @vite('resources/css/app.css')
</head>
@if (session('success'))
    <script>
        window.alert("{{ session('success') }}");
    </script>
@endif
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white max-w-sm w-full p-6 rounded shadow-md">
            <h2 class="text-2xl font-bold mb-6">Login</h2>
            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                @if(session('success'))
                    <div class="text-green-500">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="text-red-500">{{ session('error') }}</div>
                @endif
                <div class="mb-4">
                    <label class="block mb-2" for="email">Email</label>
                    <input class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" id="email" name="email" placeholder="Enter your email">
                </div>
                <div class="mb-4">
                    <label class="block mb-2" for="password">Password</label>
                    <input class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" id="password" name="password" placeholder="Enter your password">
                </div>
                <button class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600" type="submit">Sign In</button>
            </form>
            <div class="flex justify-end mt-2">
                <a href="{{ route('register') }}" class="text-blue-500 hover:underline">New user? Register</a>
            </div>
            <!-- <div class="text-center mt-4">
                <span class="text-gray-600">Or</span>
            </div>
            <div class="mt-4">
                <a href="{{ route('threads') }}" class="block text-center text-blue-500 hover:underline">Login as guest</a>
            </div> -->
        </div>
    </div>
</body>
</html>
