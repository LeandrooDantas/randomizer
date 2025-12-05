<div x-data="{ showModal: false, showRolling: false }"
     x-on:draw-start.window="showRolling = true"
     x-on:draw-end.window="showRolling = false; showModal = true">

    <!-- ====================== CSS ====================== -->
    <style>
        /* Rolling names animation */
        @keyframes rollNames {
            0% { transform: translateY(0); }
            100% { transform: translateY(-100%); }
        }

        .rolling-box {
            height: 70px;
            overflow: hidden;
            position: relative;
            background: #1d232a;
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .rolling-list {
            animation: rollNames 1.6s linear infinite;
        }

        /* Winner modal */
        .winner-modal {
            position: fixed;
            inset: 0;
            backdrop-filter: blur(4px);
            background: rgba(0,0,0,0.45);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 50;
        }

        .winner-card {
            background: #ffffff;
            padding: 34px;
            border-radius: 20px;
            width: 380px;
            text-align: center;
            animation: popWinner 0.6s ease-out forwards;
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
        }

        @keyframes popWinner {
            0% { transform: scale(0.5); opacity: 0; }
            60% { transform: scale(1.1); }
            100% { transform: scale(1); opacity: 1; }
        }

        /* Confetti burst */
        @keyframes confettiExplode {
            0% { transform: translate(0, 0) rotate(0); opacity: 1; }
            100% { transform: translate(var(--x), var(--y)) rotate(720deg); opacity: 0; }
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background: hsl(calc(var(--i) * 36), 85%, 55%);
            top: 50%;
            left: 50%;
            animation: confettiExplode 1.1s ease-out forwards;
            border-radius: 3px;
        }
    </style>

    <!-- ====================== DROPDOWN + BUTTON ====================== -->
    <div class="flex items-center justify-center">
        <div class="bg-base-200 rounded-3xl w-100 p-6">
            <div class="flex justify-center mb-4 mt-3 gap-2">
                <select wire:model="selectedPrizeDraw" id="prizeDraw" class="select select-neutral">
                    <option value="">Selecione o sorteio</option>
                    @foreach($prizeDraws as $draw)
                        <option value="{{ $draw->id }}">{{ $draw->name }}</option>
                    @endforeach
                </select>

                <button class="btn btn-primary" wire:click="drawWinner">
                    Sortear
                </button>
            </div>
        </div>
    </div>

    <!-- ====================== ROLLING NAMES ====================== -->
    @if($rollingNames ?? false)
        <div class="mt-6 flex justify-center">
            <div class="rolling-box">
                <div class="rolling-list">
                    @foreach($rollingNames as $name)
                        <div class="py-1">{{ $name }}</div>
                    @endforeach
                    @foreach($rollingNames as $name)
                        <div class="py-1">{{ $name }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- ====================== WINNER LIST ====================== -->
    @if(count($winners) > 0)
        <div class="mt-6 flex flex-col items-center">
            @foreach($winners as $winner)
                <div class="bg-base-300 w-full max-w-md p-4 rounded-xl mb-3 text-center shadow">
                    <p><strong>Nome:</strong> {{ $winner->userPrizeDraw->name }}</p>
                    <p><strong>Matrícula:</strong> {{ $winner->userPrizeDraw->registration_number }}</p>
                    <p><strong>Setor:</strong> {{ $winner->userPrizeDraw->section }}</p>
                    <p><strong>Filial:</strong> {{ $winner->userPrizeDraw->branch }}</p>
                </div>
            @endforeach
        </div>
    @endif

    <!-- ====================== WINNER MODAL ====================== -->
    <template x-if="showModal">
        <div class="winner-modal" x-on:click="showModal = false">

            <!-- Confetti Explosion -->
            <template x-for="i in 30">
                <div class="confetti"
                     :style="`
                        --i:${i};
                        --x:${(Math.random() * 200 - 100)}px;
                        --y:${(Math.random() * 200 - 100)}px;
                     `">
                </div>
            </template>

            <!-- Winner Card -->
            <div class="winner-card">

                <h2 class="text-2xl font-bold mb-3 text-primary">🎉 Parabéns! 🎉</h2>

                @if(count($winners) > 0)
                    @php $winner = $winners->last(); @endphp

                    <p class="text-xl font-semibold">
                        {{ $winner->userPrizeDraw->name }}
                    </p>

                    <p class="text-sm mt-1">
                        Matrícula: {{ $winner->userPrizeDraw->registration_number }}
                    </p>

                    <p class="text-sm">
                        Setor: {{ $winner->userPrizeDraw->section }}
                    </p>

                    <p class="text-sm">
                        Filial: {{ $winner->userPrizeDraw->branch }}
                    </p>
                @endif

                <button class="btn btn-primary btn-sm mt-4" x-on:click="showModal = false">
                    Fechar
                </button>
            </div>
        </div>
    </template>
</div>
