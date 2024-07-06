<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $terms;

    public function render() {
        return view('livewire.register');
    }

    public function register() {
        $this->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'same:password'],
            'terms' => ['accepted'],
        ]);

        $user = new User([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->save();

        Auth::login($user);

        return redirect()->intended('/dashboard/posts');
    }
}
