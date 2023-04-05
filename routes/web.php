<?php

use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::resource('mahasiswas',MahasiswaController::class);

Route::get('/', function () {
    return view('welcome');
});
Route::post('find', [MahasiswaController::class, 'find'])->name('find');
