<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('books', BookController::class);
Route::apiResource('authors', AuthorController::class);
Route::apiResource('genres', GenreController::class);

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});
