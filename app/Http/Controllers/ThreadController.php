<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;

class ThreadController extends Controller
{
    //
    // public function create()
    // {
    //     // dd('hello mukta');   
    //     $threads = Thread::all();
    //     return view('threads', compact('threads'));
    // }

    public function index()
{
    //  dd('hello');
    $threads = Thread::with('user')->get();
    // dd($threads->all()); 
    return view('threads', compact('threads'));
}
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
    
        $thread = new Thread();
        $thread->title = $request->input('title');
        $thread->content = $request->input('content');
        $thread->user_id = Auth::id();
        $thread->save();
    
        // return redirect()->route('showthreads', $thread);
        return redirect()->route('threads', $thread->id)->with('success', 'Thread created successfully.');
    }

    public function show(Thread $thread)
    {
        
        $thread->load('comments');
        // $threads = Thread::with('user')->get();

        return view('showthreads', compact('thread'));
    }

    public function update(Request $request)
    {
        
        // Retrieve the authenticated user
        $user = User::find(Auth::id());
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|string|min:6|confirmed',
        ]);
        // dd($validator);
        
        // if ($validator->fails()) {
        //     return redirect()->route('profile')->withErrors($validator)->withInput();
        // }
    // Update the username
    $user->username = $request->input('username');

    // Update the name
    $user->name = $request->input('name');
    var_dump($request->file('avatar'));
    // Update the avatar if provided
    if ($request->hasFile('avatar')) {
        // dd('avatar');
        $avatar = $request->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        $avatar->storeAs('avatars', $filename, 'public');
    
        // Delete the previous avatar if it exists
        if ($user->avatar) {
            Storage::disk('public')->delete('storage/avatars/' . $user->avatar);
        }
    
        // Update the avatar field in the user model
        $user->avatar = $filename;
    }
    
    // Update the password if provided
    $newPassword = $request->input('password');
    if ($newPassword) {
        // Logic to update the password
        $user->password = Hash::make($newPassword);
    }

    // Save the user changes
    $user->save();
    // dd('saved');

    return redirect()->back()->with('success', 'Profile updated successfully.');
}
    

}
