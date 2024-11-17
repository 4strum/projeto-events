<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;

Route::get('/', [EventController::class, 'index']);



Route::get('/produtos_teste/{id}', function ($id = null) {
    return view('product', ['id' => $id]);
});
