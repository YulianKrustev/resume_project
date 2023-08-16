<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\UniversityController;

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

Route::get('/', [IndexController::class, 'index']);

// Home Candidate Routes
Route::controller(CandidateController::class)->group(function () {
    Route::post('/store/candidate/', 'StoreCandiate')->name('candidate.profile.store');
});

// Home University Routes
Route::controller(UniversityController::class)->group(function () {
    Route::post('/store/university/', 'StoreUniversity')->name('university.store');
});




