<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ShowList;
use App\Livewire\ShowDetail;

Route::get('/', ShowList::class)->name('home');
Route::get('/show/{slug}', ShowDetail::class)->name('show.detail');
