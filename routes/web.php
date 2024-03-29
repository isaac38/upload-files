<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/upload', [FileController::class, 'index'])->name('upload');

Route::post('/upload', [FileController::class, 'store'])->name('upload.store');

Route::delete('/upload/delete/{id}', [FileController::class, 'destroy'])->name('upload.destroy');
