<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online discussion Forum</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
<!-- @if (session('success'))
    <script>
        window.alert("{{ session('success') }}");
    </script>
@endif -->

<!-- alert part -->
@if(session('success'))
    <!-- <div class="text-green-500 alert success-alert">{{ session('success') }}</div> -->
    <div class="fixed top-0 inset-x-0 z-50 flex items-center justify-center">
        <div class="bg-green-500 text-white font-bold py-2 px-4 rounded-lg shadow-lg alert">
            {{ session('success') }}
        </div>
    </div>
@endif
@if(session('error'))
    <div class="text-red-500">{{ session('error') }}</div>
@endif

<!-- end alert  -->

<nav class="bg-blue-500  text-white py-4 px-6">
    <div class="flex items-center justify-between">
        <div class="w-1/4"> <!-- Adjust the width as needed -->
            <p class="text-sm"> {{ auth()->user()->name }} </p>
            <p class="text-sm">{{ auth()->user()->username }}</p>
        </div>
        <div class="w-1/2 text-center"> <!-- Adjust the width as needed -->
            <h1 class="text-xl font-bold">Online discussion Forum</h1>
        </div>
        <div class="w-1/4 flex justify-end"> <!-- Adjust the width as needed and add justify-end class -->
            <a href="{{ route('logout') }}" class="text-m mr-4 hover:text-[20px]">Logout</a>
            <a href="#" class="text-m hover:text-[20px]" id="updateProfileBtn">Update Profile</a>
        </div>
    </div>
</nav>


    <div class="min-h-screen flex flex-col items-center justify-center">
     <div class="bg-white max-w-3xl w-full p-6 rounded shadow-md mt-[24px]">
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
                        <hr class="flex-grow border-gray-500">
                        <h2 class="text-lg font-bold mx-3">Discussions</h2>
                        <hr class="flex-grow border-gray-500">
                    </div>

                    <form action="{{ route('search') }}" method="GET">   
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative mb-6 mt-6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search threads by title" >
                    <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
                    </form>
                    @if($threads->isEmpty())
                <p>No threads found.</p>
                @else
                @foreach($threads as $thread)
                    <div class="flex items-start mb-4 border border-amber-600 p-4">
                    @if ($thread->user->avatar)
                        <img src="{{ asset('storage/avatars/' . $thread->user->avatar) }}" alt="{{$thread->user->username }}" class="h-[40px] w-[40px] rounded-[50%] mr-2">
                    @endif
                <div class="flex flex-grow justify-between">
                    <div>
                        <p class="font-bold mb-2 text-[16px] text-fuchsia-600 ">{{$thread->user->username }}</p>
                        <h3 class="font-bold">{{ $thread->title }}</h3>
                        <p class="mb-2">{{ $thread->content }}</p>
        
                        <a href="{{ route('threads.show', $thread) }}"><img class="h-[35px] w-[35px] hover:scale-110" src="{{url('/logo/comment_image.png')}}" alt="logo"></a>
                    </div>
        
                    @if(auth()->check() && auth()->user()->id === $thread->user->id)
            <!-- Display delete button for the thread owner -->
                    <form action="{{ route('delete', $thread) }}" method="POST">
                    @csrf
                <!-- @method('DELETE') -->
                <!-- <button type="submit" class="text-red-500">Delete</button> -->
                    <button class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">
	                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
	                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
	                    </svg>Delete
                    </button>
                    </form>
                     @endif
            
                </div>
            </div>
            @endforeach
            @endif
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
                <input type="password" name="password" id="password" class="border border-gray-300 rounded p-2 w-full" >
                @error('password')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="confirm_password" class="block mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="border border-gray-300 rounded p-2 w-full" >
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
    </body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        // const updateProfileBtn = document.getElementById('updateProfileBtn');
        // const updateProfileModal = document.getElementById('updateProfileModal');
        // const closeModalBtn = document.getElementById('closeModalBtn');

        // updateProfileBtn.addEventListener('click', () => {
        //     updateProfileModal.classList.remove('hidden');
        // });

        // closeModalBtn.addEventListener('click', () => {
        //     updateProfileModal.classList.add('hidden');
        // });


        //for handling alert time
        
    // Wait for the document to be ready
    // document.addEventListener('DOMContentLoaded', function() {
    //     // Get the success alert element
    //     const successAlert = document.querySelector('.alert');

    //     if (successAlert) {
    //         // Show the success alert
    //         successAlert.style.display = 'block';

    //         // Set a timeout to hide the success alert after 3 seconds (adjust the time as needed)
    //         setTimeout(function() {
    //             successAlert.style.display = 'none';
    //         }, 3000); // 3000 milliseconds = 3 seconds
    //     }
    // });

    $(document).ready(function() {

    const updateProfileBtn = $('#updateProfileBtn');
    const updateProfileModal = $('#updateProfileModal');
    const closeModalBtn = $('#closeModalBtn');

    updateProfileBtn.on('click', function(e) {
        e.preventDefault();
        updateProfileModal.removeClass('hidden');
    });

    closeModalBtn.on('click', function() {
        updateProfileModal.addClass('hidden');
    });
    // Get the success alert element
    const successAlert = $('.alert');

    if (successAlert.length) {
        // Show the success alert
        successAlert.show();

        // Set a timeout to hide the success alert after 3 seconds (adjust the time as needed)
        setTimeout(function() {
            successAlert.hide();
        }, 3000); // 3000 milliseconds = 3 seconds
    }
});



</script>

