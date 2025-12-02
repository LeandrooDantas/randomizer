<?php

use App\Livewire\Login;
use App\Livewire\Index;
use App\Livewire\Create;
use App\Livewire\Update;
use Illuminate\Support\Facades\Route;

Route::get('login', Login::class)->name('login');

Route::get('index', Index::class)->name('index');

Route::get('create', Create::class)->name('create');

Route::get('update/{id}', Update::class)->name('update');
