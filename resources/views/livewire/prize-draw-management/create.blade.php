<div>
    <div class="border border-base-300 rounded bg-white max-w-[1700px] mx-auto p-6 shadow-lg mt-4">
        <a class="btn btn-primary btn-outline" wire:navigate href="{{ route('prize-draw.management') }}">
            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M7.82843 10.9999H20V12.9999H7.82843L13.1924 18.3638L11.7782 19.778L4 11.9999L11.7782 4.22168L13.1924 5.63589L7.82843 10.9999Z"></path>
            </svg>
            Voltar
        </a>
        <div class="border border-base-300 rounded mt-4">
            <div class="border border-base-300 p-4 rounded">
                <div class="form-control flex flex-col">
                    <label class="label" for="name">
                        <span class="label-text">Nome</span>
                    </label>
                    <input wire:model="name" type="text" id="name" placeholder="Nome do sorteio" class="input input-bordered w-full"/>
                    <label class="label" for="quantity_participants">
                        <span>Participantes</span>
                    </label>
                    <input wire:model="quantity_participants" id="quantity_participants" type="number" min="1" placeholder="Quantidade de participantes" class="input input-bordered w-full"/>
                    <label for="file" class="label">Arquivo (.csv) com Nome-Matrícula-Setor-Filial dos participantes</label>
                    <input type="file" wire:model="file" accept=".csv" class="file-input file-input-bordered w-full"/>
                </div>
                <div class="flex justify-end">
                    <button wire:click="save" wire:loading.attr="disabled" class="btn btn-primary mt-4">
                        Cadastrar sorteio
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
