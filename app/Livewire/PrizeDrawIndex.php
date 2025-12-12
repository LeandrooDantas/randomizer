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
    public $isDrawing = false; // Novo: Controla o estado da animação
    public $rollingName = 'SORTEANDO...'; // Novo: Nome que será exibido durante a rolagem
    public $fakeNames = [
        'LOUISY DE OLIVEIRA VIEIRA SANTOS',
        'MARIA CLARA SOUSA PEREIRA',
        'PEDRO HENRIQUE OLIVEIRA LIMA',
        'ANA CAROLINA COSTA MENDES',
        'RAFAEL GABRIEL SANTOS FERREIRA',
        'GABRIELA EDUARDA LIMA ROCHA',
        'LUCAS GUSTAVO PEREIRA SILVA',
        'MARIANA BEATRIZ ALVES MARTINS',
        'BRUNO HENRIQUE GOMES RIBEIRO',
        'CAMILA FERNANDA RIBEIRO OLIVEIRA',
        'THIAGO HENRIQUE CARVALHO SANTOS',
        'LARISSA EDUARDA DIAS FERREIRA',
        'DANIELA MARIA MARTINS LOPES',
        'ANDRÉ LUCAS ROCHA COSTA',
        'SOFIA LARISSA MENDES ALMEIDA',
        'GUSTAVO EDUARDO ARAÚJO FREITAS',
        'BEATRIZ MARIA NUNES BARROS',
        'FELIPE HENRIQUE RODRIGUES SOUZA',
        'JULIANA LARISSA FERNANDES MORAES',
        'VINÍCIUS EDUARDO PINTO COSTA',
        'ISABELA MARIA CASTRO SILVA',
        'EDUARDO HENRIQUE BARROS MENDES',
        'CAROLINA FERNANDA MOREIRA LIMA',
        'MATHEUS EDUARDO TEIXEIRA ALVES',
        'LARISSA GABRIELA FARIAS OLIVEIRA',
    ];

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

        $this->isDrawing = true;

        $this->js('startRaffleAnimation()');

    }

    public function finalizeDraw()
    {
        if (!$this->isDrawing || !$this->raffle) {
            return;
        }

        $alreadyWinners = $this->raffle->winners->pluck('user_prize_draw_id');

        $eligible = $this->raffle->participants()
            ->whereNotIn('id', $alreadyWinners)
            ->get();

        if ($eligible->isEmpty()) {
            $this->isDrawing = false;
            return;
        }

        $picked = $eligible->random();

        $winner = PrizeDrawWinner::create([
            'prize_draw_id'      => $this->raffle->id,
            'user_prize_draw_id' => $picked->id,
        ]);

        $this->currentWinner = $winner->load('userPrizeDraw');
        $this->winners = $this->raffle->fresh()->winners()->with('userPrizeDraw')->get();
        $this->isDrawing = false; // Finaliza o estado de animação
    }

    // Novo: Método para atualizar o nome (chamado pelo JavaScript)
    public function updateRollingName()
    {
        if ($this->isDrawing) {
            // Seleciona um nome aleatório da lista de nomes falsos
            $this->rollingName = $this->fakeNames[array_rand($this->fakeNames)];
        }
    }

    public function render()
    {
        return view('livewire.prize-draw-index');
    }
}
