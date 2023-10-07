<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SymptomsController;



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

Route::get('symptoms', [SymptomsController::class, 'index'])->name('symptoms.index');
Route::post('/symptoms/save', [SymptomsController::class, 'save'])->name('symptoms.save');