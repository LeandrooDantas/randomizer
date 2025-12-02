<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    #[Title('Sorteio')]
    #[Layout('layouts.app')]
    public function render(): View
    {
        return view('livewire.index');
    }
}
