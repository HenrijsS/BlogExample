<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{

    public $email = 'test@example.com';
    public $password = 'password';

    public function render() {
        return view('livewire.login');
    }

    public function login() {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->intended('/dashboard/posts');
        }

        session()->flash('error', 'Invalid email or password');
        $this->password = null;

        return redirect()->back()->withInput();
    }
}
