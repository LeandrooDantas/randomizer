<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Login extends Component
{
    #[Title('Login')]
    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.login');
    }
}
