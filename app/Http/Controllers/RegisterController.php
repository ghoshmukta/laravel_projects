<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    //
// Show the registration form
public function showForm()
{
    return view('register');
}

 // Handle registration form submission
 public function register(Request $request)
 {

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'username' => 'required|string|max:255|unique:users',
        'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'password' => 'required|string|min:6|confirmed',
        'dob' => ['required', 'date', 'before_or_equal:' . now()->subYears(6)->format('Y-m-d')],
    ], [
        'password.confirmed' => 'The password confirmation does not match.',
        'dob.before_or_equal' => 'You must be at least 6 years old.',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = new User();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->username = $request->input('username');
    $user->password = Hash::make($request->input('password'));
    $user->dob = $request->input('dob');

    if ($request->hasFile('avatar')) {
        $avatar = $request->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        $avatar->storeAs('avatars', $filename, 'public');
        $user->avatar = $filename;
    }

    $user->save();

    return redirect('/')->with('success', 'You have registered successfully.');
 }


//  public function login(Request $request)
//  {
//     // dd('hello mukta');
//      $credentials = $request->only('email', 'password');
 
//      if (Auth::attempt($credentials)) {
//          // Authentication successful
//          return redirect()->route('threads')->with('success', 'You have logged in successfully.');
//      } else {
//          // Authentication failed
//          return redirect()->back()->with('error', 'Invalid email or password. Please try again.')->withInput();
//      }
//  }

}
