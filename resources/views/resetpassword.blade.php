

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white max-w-[30%] w-full p-6 rounded shadow-md">
            <!-- <h2 class="text-2xl font-bold mb-6">Reset Password</h2> -->
            <h2 class="text-2xl font-bold mb-6 border-dashed border-double border-4 border-indigo-600 p-1.5 text-center">Reset Password</h2>
            <form action="{{ route('update') }}" method="POST">
                @csrf
                @if(session('success'))
                    <div class="text-green-500">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="text-red-500">{{ session('error') }}</div>
                @endif
                <div class="mb-4">
                    <label class="block mb-2 " for="email">Email</label>
                    <input class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" id="email" name="email" placeholder="Enter your email">
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2" for="password">New Password</label>
                    <input class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" id="password" name="password" placeholder="Enter your password">
                    @error('password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2" for="password">Confirm New Password</label>
                    <input class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your new password">
                    @error('password_confirmation')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <button class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 mt-2" type="submit">Update Password</button>
            </form>
                <div class="flex justify-end mt-2 text-l text-blue-500 hover:underline">
                    <a href="{{ url('/') }}">Back to login</a>
                </div>
            </div>
    </div>
</body>
</html>