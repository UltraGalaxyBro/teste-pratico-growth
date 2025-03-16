<?php

use App\Livewire\ProductSearch;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home'); //Só pra chamar uma página renderizando a busca de produtos fora da área admin

