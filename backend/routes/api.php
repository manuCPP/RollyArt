<?php

use App\Models\Opera;
use App\Http\Controllers\OperaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/opere', [OperaController::class,'index']);
