<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;

Route::get('/', [EventController::class, 'index']);
Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');
Route::POST('/events', [EventController::class, 'store']);
Route::get('/events/{id}', [EventController::class, 'show']);
Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy')->middleware('auth');
Route::get('/events/edit/{id}', [EventController::class, 'edit'])->name('events.edit')->middleware('auth');
Route::put('/events/update/{id}', [EventController::class, 'update'])->name('events.update')->middleware('auth');;

Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');


