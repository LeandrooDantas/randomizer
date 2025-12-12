<?php

namespace App\Livewire;

use App\Models\PrizeDraw;
use App\Models\PrizeDrawWinner;
use App\Models\UsersPrizeDraw;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class PrizeDrawIndex extends Component
{
    public $prizeDraws = [];
    public $selectedPrizeDraw = '';
    public $raffle = null;
    public $currentWinner = null;
    public $winners = [];

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
            $this->winners = [];
            $this->currentWinner = null;
            return;
        }
        $this->raffle = PrizeDraw::with(['participants', 'winners.userPrizeDraw'])
            ->find($this->selectedPrizeDraw);

        $this->winners = $this->raffle->winners;
        $this->currentWinner = null;
    }

    public function drawWinner()
    {
        if (!$this->raffle) {
            return;
        }
        $alreadyWinners = $this->raffle->winners->pluck('user_prize_draw_id');

        $eligible = $this->raffle->participants()
            ->whereNotIn('id', $alreadyWinners)
            ->get();

        if ($eligible->isEmpty()) {
            return;
        }

        $picked = $eligible->random();

        $winner = PrizeDrawWinner::create([
            'prize_draw_id'      => $this->raffle->id,
            'user_prize_draw_id' => $picked->id,
        ]);

        $this->currentWinner = $winner->load('userPrizeDraw');
        $this->winners = $this->raffle->fresh()->winners()->with('userPrizeDraw')->get();
    }

    public function render()
    {
        return view('livewire.prize-draw-index');
    }
}
