<?php

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
Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('registration_page');
});
Route::get('/voter-verification', function () {
    return view('voter_pass_verification');
});
Route::get('/vote', function () {
    return view('voting_page');
});
Route::get('/results', function () {
    return view('election_results_page');
});
Route::get('/candidates', function () {
    return view('candidates');
});
