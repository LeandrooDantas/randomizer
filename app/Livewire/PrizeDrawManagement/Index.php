<?php

namespace App\Livewire\PrizeDrawManagement;

use App\Models\PrizeDraw;
use App\Models\PrizeDrawWinner;
use Livewire\Attributes\Title;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    public string $raffleName;
    public $participants = [];
    public $winner = [];
    #[Title('Gerenciar Sorteios')]
    #[Layout('components.layouts.app')]
    public function render(): View
    {
        return view('livewire.prize-draw-management.index');
    }

    public function mount()
    {
        $raffle = PrizeDraw::latest()->first();

        if (!$raffle) {
            $this->raffleName = '';
            $this->participants = [];
            $this->winner = [];
            return;
        }

        $this->raffleName = $raffle->name;
        $this->participants = $raffle->participants;
        $this->winner = $raffle->winners;
    }

    public function resetWinner($winnerId)
    {
        $winner = PrizeDrawWinner::find($winnerId);

        if ($winner) {
            $winner->delete();
        }
        $raffle = PrizeDraw::latest()->first();
        $this->winner = $raffle->winners()->with('userPrizeDraw')->get();
    }

    public function deleteDraw()
    {
        $raffle = PrizeDraw::latest()->first();

        if ($raffle) {
            $raffle->participants()->delete();
            $raffle->winners()->delete();
            $raffle->delete();
        }

        $this->raffleName = '';
        $this->participants = [];
        $this->winner = [];
    }
}
