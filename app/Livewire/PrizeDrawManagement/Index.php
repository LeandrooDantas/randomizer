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
    public $raffleName = [];
    public $raffle_id;
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
        $raffle = PrizeDraw::all();

        if (!$raffle) {
            $this->raffleName = [];
            $this->participants = [];
            $this->winner = [];
            return;
        }

        $this->raffleName = PrizeDraw::with(['participants', 'winners.userPrizeDraw'])->orderBy('created_at', 'desc')->get();

        $this->winner = PrizeDrawWinner::find($this->raffle_id)?->winners()->with('userPrizeDraw')->get() ?? [];
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

    public function delete(int $id)
    {
        $prizeDraw = PrizeDraw::findOrFail($id);
        $prizeDraw->delete();

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'Sorteio deletado com sucesso.',
        ]);

       return redirect()->route('prize-draw-management.index');
    }
}
