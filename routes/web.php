<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', [ContactController::class, 'index']);

Route::post('/contact', [ContactController::class, 'store']);

Route::get('/contact', [ContactController::class, 'store']);

