<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth as LoginRandomizer;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{
    public string $email;
    public string $password;
    #[Title('Login')]
    #[Layout('components.layouts.app')]
    public function login(): void
    {
        $this->validate();
        $credentials = [
            'email' => $this->email,
            'password' => $this->password
        ];
        if (LoginRandomizer::attempt($credentials)) :
            $this->redirectRoute('prize-draw.index');
        endif;
        $this->addError('incorrect_password', 'Usuário ou senha inválida. Tente novamente.');
    }

    public function render(): View
    {
        return view('livewire.login');
    }
}
