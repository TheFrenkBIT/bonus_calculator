<?php

use App\Http\Controllers\BonusController;
use Illuminate\Support\Facades\Route;


Route::post('/calculate-bonus', [BonusController::class, 'calculate']);