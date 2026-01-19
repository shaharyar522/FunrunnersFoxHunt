<?php

use App\Http\Controllers\indexController;
use Illuminate\Support\Facades\Route;

Route::get('/',[indexController::class, 'index']);
