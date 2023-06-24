<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white max-w-[40%] w-full p-6 rounded shadow-md">
            <h2 class="text-3xl font-bold mb-8 text-center border-4 border-indigo-200 border-y-indigo-500 p-2">User Registration</h2>
            <form method="POST" action="{{ route('register.submit') }}" enctype="multipart/form-data">
            @csrf
                <div class="mb-4">
                    <label class="block mb-2 font-bold text-[20px]" for="name">Name</label>
                    <input class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2 font-bold text-[20px]" for="username">Username</label>
                    <input class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" id="username" name="username" placeholder="Choose a username" value="{{ old('username') }}" required>
                    @error('username')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2 font-bold text-[20px]" for="email">Email</label>
                    <input class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2 font-bold text-[20px]" for="dob">Date of Birth</label>
                    <input class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" type="date" id="dob" name="dob" placeholder="Enter your date of birth" required>
                    @error('dob')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2 font-bold text-[20px]" for="avatar">Avatar</label>
                    <input class="border-gray-300 rounded p-2" type="file" id="avatar" name="avatar" accept="image/*">
                    @error('avatar')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2 font-bold text-[20px]" for="password">Password</label>
                    <input class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" id="password" name="password" placeholder="Enter your password" required>
                    @error('password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2 font-bold text-[20px]" for="password_confirmation">Confirm Password</label>
                    <input class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                    @error('password_confirmation')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <button class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 mt-2" type="submit">Register</button>
            </form>
                <div class="flex justify-end mt-2 text-l text-blue-500 hover:underline">
                    <a href="{{ url('/') }}">Back to login</a>
                </div>
            <!-- <div class="mt-4 text-center">
                <span class="text-gray-600">Already have an account?</span>
                <a href="#" class="text-blue-500 ml-1">Login</a>
            </div> -->
        </div>
    </div>
</body>
</html>
