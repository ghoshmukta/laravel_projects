<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
// use Symfony\Component\HttpFoundation\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function login(Request $request)
 {
    // dd('hello mukta');
     $credentials = $request->only('email', 'password');
 
     if (Auth::attempt($credentials)) {
         // Authentication successful
         return redirect()->route('threads')->with('success', 'You have logged in successfully.');
     } else {
         // Authentication failed
         return redirect()->back()->with('error', 'Invalid email or password. Please try again.')->withInput();
     }
 }


// public function login(Request $request)
// {
//     $resetPassword = false; // Set the initial value to false
    
//     // Check if the reset password token exists in the request
//     if ($request->has('token')) {
//         // Perform your logic to validate the reset password token
//         // If the token is valid, set $resetPassword to true
//         $resetPassword = true;
//     }

//     $credentials = $request->only('email', 'password');

//     if (Auth::attempt($credentials)) {
//         // Authentication successful
//         if ($resetPassword) {
//             // Redirect to the reset password page
//             return redirect()->route('password.reset', ['token' => $request->token])->with('resetPassword', true);
//         } else {
//             return redirect()->route('threads')->with('success', 'You have logged in successfully.');
//         }
//     } else {
//         // Authentication failed
//         return redirect()->back()->with('error', 'Invalid email or password. Please try again.')->withInput();
//     }
// }




    public function destroy(Request $request){
        Auth::logout();
        return redirect('/');
    }

    public function resetPassword()
    {
        # code...
        return view('resetpassword');
    }

    public function updatePassword(Request $request)
    {
        # code...
        // dd($request->all());
        // return redirect('/');

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ],['password.confirmed' => 'The password confirmation does not match.',]
    );
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return redirect()->back()->with('error', 'Invalid email. Please try again.')->withInput();
        }
    
        // $user->password = bcrypt($request->password);
        $user->password = Hash::make($request->input('password'));
        $user->save();
    
        return redirect('/')->with('success', 'Password updated successfully.');
    }

}
