<?php

use App\Livewire\Login;
use App\Livewire\PrizeDrawIndex;
use App\Livewire\PrizeDrawManagement\Create;
use App\Livewire\PrizeDrawManagement\Index;
use Illuminate\Support\Facades\Route;

Route::get('login', Login::class)->name('login');

Route::prefix('prize-draw')
    ->name('prize-draw.')
    ->group(function () {

        Route::middleware('auth')->group(function () {
            Route::get('index', PrizeDrawIndex::class)->name('index');
            Route::get('create', Create::class)->name('create');
            Route::get('management', Index::class)->name('management');
        });
    });
