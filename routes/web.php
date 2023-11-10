<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrimeYearController;

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
    return view('index');
});

Route::get('/index', [PrimeYearController::class, 'index'])->name('index');
Route::post('/handle-input', [PrimeYearController::class, 'saveChristmasDates'])->name('handleInput');
Route::get('/prime-years', [PrimeYearController::class, 'getChristmasDays'])->name('getPrimeYearsData');
