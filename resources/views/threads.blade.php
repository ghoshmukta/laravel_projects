<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online discussion Forum</title>
    @vite('resources/css/app.css')
    <style>
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .divider {
            flex-grow: 1;
            height: 1px;
            background-color: #E5E7EB;
        }
        .content-container {
        margin-top: 24px; /* Adjust the margin value as needed */
    }
    
    </style>
</head>

<body class="bg-gray-100">
@if (session('success'))
    <script>
        window.alert("{{ session('success') }}");
    </script>
@endif
<nav class="bg-blue-500 text-white py-4 px-6">
    <div class="flex items-center justify-between">
        <div class="w-1/4"> <!-- Adjust the width as needed -->
            <p class="text-sm">{{ auth()->user()->name }}</p>
            <p class="text-sm">{{ auth()->user()->username }}</p>
        </div>
        <div class="w-1/2 text-center"> <!-- Adjust the width as needed -->
            <h1 class="text-xl font-bold">Online discussion Forum</h1>
        </div>
        <div class="w-1/4 flex justify-end"> <!-- Adjust the width as needed and add justify-end class -->
            <a href="{{ route('logout') }}" class="text-sm mr-4">Logout</a>
            <a href="#" class="text-sm" id="updateProfileBtn">Update Profile</a>
        </div>
    </div>
</nav>

    <div class="min-h-screen flex flex-col items-center justify-center">
    <div class="bg-white max-w-3xl w-full p-6 rounded shadow-md content-container">
        <div class="bg-white max-w-3xl w-full p-6 rounded shadow-md">
            <form action="{{ route('threads.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block mb-2">Title</label>
                    <input type="text" name="title" id="title" class="border border-gray-300 rounded p-2 w-full" required>
                </div>
                <div class="mb-4">
                    <label for="content" class="block mb-2">Content</label>
                    <textarea name="content" id="content" rows="6" class="border border-gray-300 rounded p-2 w-full" required></textarea>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-auto block">Create Thread</button>
            </form>

            <div class="mt-8">
                <div class="flex items-center mb-4">
                        <hr class="flex-grow border-gray-300">
                        <h2 class="text-lg font-bold mx-4">Discussions</h2>
                        <hr class="flex-grow border-gray-300">
                </div>
                @foreach($threads as $thread)
                <div class="flex items-start mb-4"> <!-- Use "items-start" class -->
                     @if ($thread->user->avatar)
                        <img src="{{ asset('storage/avatars/' . $thread->user->avatar) }}" alt="{{ $thread->user->username }}" class="avatar mr-2">
                     @endif
                    <div>
                        <p class="font-bold mb-1">{{ $thread->user->username }}</p>
                        <h3 class="font-bold">{{ $thread->title }}</h3>
                        <p>{{ $thread->content }}</p>
                        <a href="{{ route('threads.show', $thread) }}">View Comments</a>
                    </div>
                </div>
                @endforeach
            </div>
               
            </div>
        </div>
    </div>
    </div>


 <!-- Update Profile Modal -->
<div id="updateProfileModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 overflow-auto">
    <div class="bg-white p-6 rounded-lg shadow-md w-1/3  top-8 mb-8 absolute">
        <h2 class="text-lg font-bold mb-4">Update Profile</h2>
        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label for="username" class="block mb-2">Username</label>
                <input type="text" name="username" id="username" class="border border-gray-300 rounded p-2 w-full" value="{{ auth()->user()->username }}" required>
                @error('username')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="avatar" class="block mb-2">Avatar</label>
                <input type="file" name="avatar" id="avatar" class="border border-gray-300 rounded p-2 w-full">
                @error('avatar')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="name" class="block mb-2">Name</label>
                <input type="text" name="name" id="name" class="border border-gray-300 rounded p-2 w-full" value="{{ auth()->user()->name }}" required>
                @error('name')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <h3 class="text-lg font-bold mb-2">Update Password</h3>
                <label for="new_password" class="block mb-2">New Password</label>
                <input type="password" name="password" id="password" class="border border-gray-300 rounded p-2 w-full" required>
                @error('password')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="confirm_password" class="block mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="border border-gray-300 rounded p-2 w-full" required>
                @error('password_confirmation')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-auto block">Update</button>
        </form>
        <button id="closeModalBtn" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mx-auto block mt-4">Close</button>
    </div>
</div>

    <!-- end of modal -->


    <script>
        const updateProfileBtn = document.getElementById('updateProfileBtn');
        const updateProfileModal = document.getElementById('updateProfileModal');
        const closeModalBtn = document.getElementById('closeModalBtn');

        updateProfileBtn.addEventListener('click', () => {
            updateProfileModal.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', () => {
            updateProfileModal.classList.add('hidden');
        });
    </script>
</body>
</html>
