<?php

use App\Http\Controllers\TrainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TrainController::class, 'index'])->name('home');
