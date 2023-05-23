<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];
    
        $user = User::where('email', $this->email)->first();
    
        if ($user && Hash::check($this->password, $user->password)) {
            dd('login');
            // Authentication successful
            session()->flash('success', 'You have logged in successfully.');
            return redirect()->route('threads');
        } else {
            // Authentication failed
            session()->flash('error', 'Invalid email or password. Please try again.');
            $this->resetInputs();
        }
    }

    private function resetInputs()
    {
        $this->email = '';
        $this->password = '';
    }

    public function render()
    {
        return view('login');
    }
    
}
