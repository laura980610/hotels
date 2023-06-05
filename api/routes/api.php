<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HotelsController;
use App\Http\Controllers\Api\HotelsCaractController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(HotelsController::class)->group(function (){
    Route::get('/hotels', 'index');
    Route::post('/hotels', 'store');
    Route::get('/hotels/{id}', 'show');
    Route::put('/hotels/{id}', 'update');
    Route::delete('/hotels/{id}', 'destroy');

    
});

Route::controller(HotelsCaractController::class)->group(function (){
    Route::post('/hotelscaract/{id}', 'store');
    Route::delete('/hotelscaract/{id}', 'destroy');

});
