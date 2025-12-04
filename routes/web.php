<?php

use App\Livewire\Create;
use App\Livewire\Index;
use App\Livewire\Login;
use App\Livewire\PrizeDrawManagement\index as PrizeDrawIndex;
use Illuminate\Support\Facades\Route;

Route::get('prize-draw/login', Login::class)->name('login');

Route::prefix('prize-draw')
    ->name('prize-draw.')
    ->group(function () {

        Route::middleware('auth')->group(function () {
            Route::get('index', Index::class)->name('index');
            Route::get('create', Create::class)->name('create');
            Route::get('management', PrizeDrawIndex::class)->name('management');
        });
    });
