<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\EnsureUserIsECPAdmin;
use Illuminate\Support\Facades\Auth;
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

Route::middleware([EnsureUserIsECPAdmin::class])->group(function() {
	Route::get('/ecp_dashboard', function(){
		return view('about_us');
	});
});
Route::middleware([Authenticate::class])->group(function () {

	Route::get('/voter-verification', function () {
		return view('voter_pass_verification');
	});
	Route::get('/profile', function () {
		return view('profile_page');
	});
	Route::get('/vote', function () {
		return view('voting_page');
	});
});

Route::get('/', function () {
	if (Auth::check()) {
		return view('welcome', [
			'user' => Auth::user(),
		]);
	}
	return view('welcome');
});

Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::get('/login', function () {
	return view('login');
});

Route::get('/register', function () {
	return view('registration_page');
});
Route::post('/register', [UserController::class, 'store']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/results', function () {
	return view('election_results_page');
});
Route::get('/candidates', function () {
	return view('candidates');
});
Route::get('/about-us', function () {
	return view('about_us');
});
