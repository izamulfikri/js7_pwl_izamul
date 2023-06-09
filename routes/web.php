<?php

use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::resource('mahasiswas',MahasiswaController::class);
Route::get('/mahasiswas/detailnilai/{nim}',[MahasiswaController::class,"detailnilai"])->name('detailnilai');

Route::get('/', function () {
    return view('welcome');
});
Route::post('find', [MahasiswaController::class, 'find'])->name('find');

Route::get('/article/cetak_pdf', [ArticleController::class, 'cetak_pdf']);
Route::get('/mahasiswas/{nim}/exportPDF', [MahasiswaController::class, 'exportPDF'])->name('mahasiswas.exportPDF');
?>