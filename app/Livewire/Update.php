<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Update extends Component
{
    #[Title('Atualizar Sorteio')]
    #[Layout('components.layouts.app')]
    public function render(): View
    {
        return view('livewire.update');
    }
}
