<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Thread</title>
    @vite('resources/css/app.css')
    <style>
         .home-link {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #3182ce;
            font-weight: bold;
        }

        .home-link svg {
            width: 16px;
            height: 16px;
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="max-w-2xl mx-auto bg-white border border-gray-300 p-4">
    <a href="{{ route('threads') }}" class="home-link">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Home
        </a>
        <h1 class="text-2xl font-bold mb-4">{{ $thread->title }}</h1>
        <div class="mb-4">
            <p>{{ $thread->content }}</p>
        </div>
        <div class="mb-4">
            <h2 class="text-xl font-bold mb-2">Comments</h2>
            @forelse ($thread->comments as $comment)
    <div class="border border-gray-300 rounded p-4 mb-4">
        <p class="font-bold">{{ $comment->user->name }}</p>
        <p>{{ $comment->body }}</p>
        @if ($comment->is_best_reply)
            <span class="text-green-500">Best Reply</span>
        @endif
        @if (auth()->check() && $thread->user_id === auth()->user()->id && !$comment->is_best_reply)
            <form action="{{ route('comments.markAsBestReply', $comment->id) }}" method="POST">
                @csrf
                <button type="submit" class="text-blue-500 hover:text-blue-700">Mark as Best Reply</button>
            </form>
        @endif
    </div>
@empty
    <p>No comments yet.</p>
@endforelse


        </div>
        <!-- Add comment form here -->
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="thread_id" value="{{ $thread->id }}">
            <div class="mb-4">
                <label for="body" class="block mb-2">Comment</label>
                <textarea name="body" id="body" rows="4" class="border border-gray-300 rounded p-2" required></textarea>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Post Comment</button>
        </form>
    </div>
</body>
</html>
