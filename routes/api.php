<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgencyController;

Route::post('/agencies', [AgencyController::class, 'store']);
Route::get('/agencies', [AgencyController::class, 'show']);
