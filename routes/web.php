<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/cars');

Route::resource('cars', CarController::class);
