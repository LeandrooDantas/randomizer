<div>
    <dialog id="my_modal_5" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Resetar ganhador</h3>
            @foreach($winner as $w)
                <div class="flex items-center gap-4 mt-3 border-b pb-2">
                    <div>
                        <span class="font-semibold block">{{ $w->userPrizeDraw->name }}</span>
                        <span class="text-sm text-gray-500">Matrícula: {{ $w->userPrizeDraw->registration_number }}</span>
                    </div>

                    <button class="btn btn-sm btn-outline ml-auto" wire:click="resetWinner({{ $w->id }})">
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M5.46257 4.43262C7.21556 2.91688 9.5007 2 12 2C17.5228 2 22 6.47715 22 12C22 14.1361 21.3302 16.1158 20.1892 17.7406L17 12H20C20 7.58172 16.4183 4 12 4C9.84982 4 7.89777 4.84827 6.46023 6.22842L5.46257 4.43262ZM18.5374 19.5674C16.7844 21.0831 14.4993 22 12 22C6.47715 22 2 17.5228 2 12C2 9.86386 2.66979 7.88416 3.8108 6.25944L7 12H4C4 16.4183 7.58172 20 12 20C14.1502 20 16.1022 19.1517 17.5398 17.7716L18.5374 19.5674Z"></path>
                        </svg>
                        Resetar ganhador
                    </button>
                </div>
            @endforeach
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <div class="border border-base-300 rounded bg-white max-w-[1700px] mx-auto mt-10 p-6 shadow-lg">
        <div class="flex items-center">
            <a wire:navigate href="{{ route('prize-draw.index') }}" class="btn btn-primary btn-outline ml-3">
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M7.82843 10.9999H20V12.9999H7.82843L13.1924 18.3638L11.7782 19.778L4 11.9999L11.7782 4.22168L13.1924 5.63589L7.82843 10.9999Z"></path>
                </svg>
                Voltar
            </a>
            <a wire:navigate href="{{ route('prize-draw.create') }}" class="btn btn-primary ml-auto">
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"></path>
                </svg>
                Novo sorteio
            </a>
        </div>

        <table class="table table-zebra w-full mt-4">
            <thead>
            <tr>
                <th class="text-lg">Nome do sorteio</th>
                <th class="text-lg">Participantes</th>
                <th class="text-lg">Ganhadores</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($raffleName as $raffle)
                <tr>
                    <td>{{ $raffle->name }}</td>
                    <td>{{ $raffle->participants->count() }}</td>
                    <td>
                        @if($raffle->winners->isEmpty())
                            Nenhum ganhador sorteado
                        @else
                            {{ $raffle->winners->count() }}
                        @endif
                    </td>

                    <td class="text-right space-x-2">
                        <a href="{{route('prize-draw.index')}}" class="btn btn-primary btn-sm">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19 5V19H5L5 5H19ZM5 3C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H5ZM16.5 15C16.5 15.8284 15.8284 16.5 15 16.5C14.1716 16.5 13.5 15.8284 13.5 15C13.5 14.1716 14.1716 13.5 15 13.5C15.8284 13.5 16.5 14.1716 16.5 15ZM9 10.5C9.82843 10.5 10.5 9.82843 10.5 9C10.5 8.17157 9.82843 7.5 9 7.5C8.17157 7.5 7.5 8.17157 7.5 9C7.5 9.82843 8.17157 10.5 9 10.5Z"></path>
                            </svg>
                            Sortear ganhador
                        </a>
                        <button class="btn btn-outline btn-sm" onclick="my_modal_5.showModal()">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M5.46257 4.43262C7.21556 2.91688 9.5007 2 12 2C17.5228 2 22 6.47715 22 12C22 14.1361 21.3302 16.1158 20.1892 17.7406L17 12H20C20 7.58172 16.4183 4 12 4C9.84982 4 7.89777 4.84827 6.46023 6.22842L5.46257 4.43262ZM18.5374 19.5674C16.7844 21.0831 14.4993 22 12 22C6.47715 22 2 17.5228 2 12C2 9.86386 2.66979 7.88416 3.8108 6.25944L7 12H4C4 16.4183 7.58172 20 12 20C14.1502 20 16.1022 19.1517 17.5398 17.7716L18.5374 19.5674Z"></path>
                            </svg>
                            Resetar ganhador
                        </button>
                        <button class="btn btn-outline btn-error btn-sm" wire:click="delete({{ $raffle->id }})" wire:confirm="Tem certeza que deseja excluir este sorteio?">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 11H11V17H9V11ZM13 11H15V17H13V11ZM9 4V6H15V4H9Z"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
