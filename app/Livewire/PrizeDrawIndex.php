<?php

namespace App\Livewire;

use App\Models\PrizeDraw;
use App\Models\PrizeDrawWinner;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\View\View;

class PrizeDrawIndex extends Component
{
    public $prizeDraws = [];
    public $selectedPrizeDraw = '';
    public $winners = [];
    public $raffle = null;

    #[Title('Sorteio')]
    #[Layout('components.layouts.app')]
    public function mount()
    {
        $this->prizeDraws = PrizeDraw::orderBy('id', 'desc')->get();
    }

    public function updatedSelectedPrizeDraw()
    {
        if (!$this->selectedPrizeDraw) {
            $this->raffle = null;
            return;
        }

        $this->raffle = PrizeDraw::with(['participants'])
            ->find($this->selectedPrizeDraw);
    }

    public function drawWinner()
    {
        if (!$this->raffle) {
            return;
        }

        $alreadyWinners = $this->raffle->winners->pluck('user_prize_draw_id');

        $eligible = $this->raffle->participants()->whereNotIn('id', $alreadyWinners)->get();

        $picked = $eligible->random();

        PrizeDrawWinner::create([
            'prize_draw_id'      => $this->raffle->id,
            'user_prize_draw_id' => $picked->id,
        ]);

        $this->winners = $this->raffle->fresh()->winners()->with('userPrizeDraw')->get();
    }

    public function render(): View
    {
        return view('livewire.prize-draw-index');
    }
}
