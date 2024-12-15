<?php

use App\Interfaces\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(static function (): void {
    Route::get('me', [ProfileController::class, 'me']);
});
