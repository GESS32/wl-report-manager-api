<?php

use App\Interfaces\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('me', [ProfileController::class, 'me']);
