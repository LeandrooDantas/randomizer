<div>
    <div class="flex items-center justify-center">
        <div class="bg-base-200 rounded-3xl w-100 p-6">
            <div class="flex justify-center mb-4 mt-3 gap-2">
                <select wire:model="selectedPrizeDraw" id="prizeDraw" class="select select-neutral">
                    <option value="">Selecione o sorteio</option>
                    @foreach($prizeDraws as $draw)
                        <option value="{{ $draw->id }}">{{ $draw->name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-ghost px-0" wire:click="drawWinner">
                    <svg class="size-13" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 5V19H5L5 5H19ZM5 3C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H5ZM16.5 15C16.5 15.8284 15.8284 16.5 15 16.5C14.1716 16.5 13.5 15.8284 13.5 15C13.5 14.1716 14.1716 13.5 15 13.5C15.8284 13.5 16.5 14.1716 16.5 15ZM9 10.5C9.82843 10.5 10.5 9.82843 10.5 9C10.5 8.17157 9.82843 7.5 9 7.5C8.17157 7.5 7.5 8.17157 7.5 9C7.5 9.82843 8.17157 10.5 9 10.5Z"></path>
                    </svg>
                </button>

            </div>
        </div>
    </div>
    @if(count($winners) > 0)
        <div class="mt-6 flex flex-col items-center">
            @foreach($winners as $winner)
                <div class="bg-base-300 w-full max-w-md p-4 rounded-xl mb-3 text-center">
                    <p><strong>Nome:</strong> {{ $winner->userPrizeDraw->name }}</p>
                    <p><strong>Matrícula:</strong> {{ $winner->userPrizeDraw->registration_number }}</p>
                    <p><strong>Setor:</strong> {{ $winner->userPrizeDraw->section }}</p>
                    <p><strong>Filial:</strong> {{ $winner->userPrizeDraw->branch }}</p>
                </div>
            @endforeach
        </div>
    @endif

</div>
