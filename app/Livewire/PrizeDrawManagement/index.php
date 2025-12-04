<?php

namespace App\Livewire\PrizeDrawManagement;

use App\Models\PrizeDraw;
use Livewire\Attributes\Title;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class index extends Component
{
    public string $raffleName;
    public $participants = [];
    public string $winner;
    #[Title('Gerenciar Sorteios')]
    #[Layout('components.layouts.app')]
    public function render(): View
    {
        return view('livewire.prize-draw-management.index');
    }

    public function mount()
    {
        $this->raffleName = PrizeDraw::all()->last()->name ?? 'Sorteio';
        $this->participants = PrizeDraw::all()->last()->participants ?? [];
        $this->winner = PrizeDraw::all()->last()->winner ?? '';
    }
}
