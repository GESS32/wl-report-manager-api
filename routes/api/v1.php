<?php

use App\Interfaces\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::prefix('private')->group(static function (): void {
    // @TODO:: implement admin routing
});

Route::prefix('public')->group(static function (): void {
    /** @see routes/api/resources/auth.php */
    Route::prefix('auth')->group(base_path('routes/api/resources/auth.php'));

    /** @see routes/api/resources/profile.php */
    Route::prefix('profile')->group(base_path('routes/api/resources/profile.php'));

    Route::middleware('auth:api')->group(static function (): void {
        Route::post('report', [ReportController::class, 'store']);
    });
});
