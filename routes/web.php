<?php

use App\Livewire\Create;
use App\Livewire\Index;
use App\Livewire\Login;
use App\Livewire\Update;
use Illuminate\Support\Facades\Route;


Route::prefix('prize-draw')
    ->name('prize-draw.')
    ->group(function () {

        Route::get('login', Login::class)->name('login');

        Route::middleware('auth')->group(function () {
            Route::get('index', Index::class)->name('index');
            Route::get('create', Create::class)->name('create');
            Route::get('update/{id}', Update::class)->name('update');
        });
    });
