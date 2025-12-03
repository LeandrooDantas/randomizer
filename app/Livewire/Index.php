<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    #[Title('Sorteio')]
    #[Layout('components.layouts.app')]
    public function render(): View
    {
        return view('livewire.index');
    }
}
