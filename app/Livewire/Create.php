<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Create extends Component
{
    #[Title('Criar Sorteio')]
    #[Layout('components.layouts.app')]
    public function render(): View
    {
        return view('livewire.create');
    }

}
