<?php

namespace App\Livewire\PrizeDrawManagement;

use App\Models\PrizeDraw;
use App\Models\PrizeDrawWinner;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Title;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    public $raffleName = [];
    public $selectedRaffle;
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
//        $this->selectedRaffle = new Collection();

        $raffle = PrizeDraw::all();

        if (!$raffle) {
            $this->raffleName = [];
            $this->participants = [];
            $this->winner = [];
            return;
        }

        $this->raffleName = PrizeDraw::with(['participants', 'winners.userPrizeDraw'])->orderBy('created_at', 'desc')->get();
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

    public function openResetModal(PrizeDraw $prizeDraw)
    {
        $this->selectedRaffle = $prizeDraw;
        $this->js('my_modal_5.showModal()');
    }

}
