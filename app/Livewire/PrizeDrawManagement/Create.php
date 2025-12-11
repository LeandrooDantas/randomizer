<?php

namespace App\Livewire\PrizeDrawManagement;

use App\Models\PrizeDraw;
use App\Models\UsersPrizeDraw;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;


class Create extends Component
{
    use WithFileUploads;

    public string $name = '';
    public int|string $quantity_participants = '';
    public $file;

    #[Title('Criar Sorteio')]
    #[Layout('components.layouts.app')]
    public function render(): View
    {
        return view('livewire.prize-draw-management.create');
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'quantity_participants' => 'required|integer|min:1',
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $sorteio = PrizeDraw::create([
            'name' => $this->name,
            'quantity_participants' => $this->quantity_participants,
        ]);

        $path = $this->file->store('csv_temp');
        $csv = Storage::get($path);

        $firstLine = strtok($csv, "\n");
        $separator = str_contains($firstLine, ';') ? ';' : ',';

        $lines = explode("\n", $csv);

        array_shift($lines);

        foreach ($lines as $line) {

            $line = trim($line);
            if ($line === '') {
                continue;
            }

            $cols = str_getcsv($line, $separator);

            if (count($cols) < 4) {
                continue;
            }

            UsersPrizeDraw::create([
                'prize_draw_id' => $sorteio->id,
                'name'          => $cols[0],
                'registration_number'  => $cols[1],
                'section'        => $cols[2],
                'branch'        => $cols[3],
            ]);
        }

        Storage::delete($path);

        session()->flash('success', 'Sorteio criado com sucesso!');
        redirect()->route('prize-draw-management.index');
    }
}
