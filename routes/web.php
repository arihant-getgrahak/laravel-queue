<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FileManagerController;


Route::get('/', [FileManagerController::class, 'index']);

Route::post('/store', [FileManagerController::class, 'store']);


Route::get('/contact-us', [ContactController::class, 'index']);

Route::post('/contact', [ContactController::class, 'store']);


