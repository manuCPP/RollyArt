<?php

use App\Http\Controllers\ContactController;
use App\Models\Opera;
use App\Http\Controllers\OperaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/opere', [OperaController::class,'index']);
Route::post('/upload', [OperaController::class,'store']);
Route::get('/immagini/{filename}', function($filename){
    $path = storage_path("app/private/{$filename}");

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
});

Route::post('/contact', [ContactController::class,'send']);
Route::delete('/opera/{id}', [OperaController::class, 'destroy']);

