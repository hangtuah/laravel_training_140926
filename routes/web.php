<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//ROOMS
Route::get('/rooms', [App\Http\Controllers\RoomController::class, 'index'])
    ->name('rooms.index');

Route::get('/rooms/add', [App\Http\Controllers\RoomController::class, 'add'])
    ->name('rooms.add');

Route::post('/rooms/store', [App\Http\Controllers\RoomController::class, 'store'])
    ->name('rooms.store');

Route::get('/rooms/edit/{room_id}', [App\Http\Controllers\RoomController::class, 'edit'])
    ->name('rooms.edit');

Route::put('/rooms/update/{room_id}', [App\Http\Controllers\RoomController::class, 'update'])
    ->name('rooms.update');

Route::delete('/rooms/delete/{room_id}', [App\Http\Controllers\RoomController::class, 'destroy'])
    ->name('rooms.destroy');

//BOOKING
Route::get('/bookings', [App\Http\Controllers\BookingController::class, 'index'])
    ->name('bookings.index');

Route::get('/bookings/add', [App\Http\Controllers\BookingController::class, 'add'])
    ->name('bookings.add');

Route::post('/bookings/store', [App\Http\Controllers\BookingController::class, 'store'])
    ->name('bookings.store');

Route::get('/bookings/edit/{booking_id}', [App\Http\Controllers\BookingController::class, 'edit'])
    ->name('bookings.edit');

Route::put('/bookings/update/{booking_id}', [App\Http\Controllers\BookingController::class, 'update'])
    ->name('bookings.update');

Route::delete('/bookings/delete/{booking_id}', [App\Http\Controllers\BookingController::class, 'destroy'])
    ->name('bookings.destroy');
