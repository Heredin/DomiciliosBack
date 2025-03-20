<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Domicilio\DomicilioController;

Route::middleware(['auth'])->group(function () {
    Route::post('/domicilios', [DomicilioController::class, 'store']);
    Route::post('/domicilios/{domicilio}', [DomicilioController::class, 'update']);
    Route::get('/domicilios/{domicilio}', [DomicilioController::class, 'show'])->missing(
        fn() => response()->json(
            [
                'status' => 'failed',
                'message' => 'task not found'
            ],
            404
        )
    );
    Route::delete('/domicilios/{domicilio}', [DomicilioController::class, 'delete']);
});
Route::get('/domicilios/user/{user}', [DomicilioController::class, 'getUserDomicilios'])->missing(
    fn() => response()->json(
        [
            'status' => 'failed',
            'message' => 'user not found'
        ],
        404
    )
);
