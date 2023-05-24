<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ECPController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\EnsureUserIsECPAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

Route::middleware([Authenticate::class, EnsureUserIsECPAdmin::class])->prefix('admin')->group(function () {
	Route::get('/dashboard', function () {
		return view('admin_panel_home');
	});
	Route::get('/upload_candidates', function () {
		return view('ecp.upload_candidates');
	});
	Route::post('/upload_candidates', [ECPController::class, 'uploadElectionCandidatesCSV']);
});
Route::middleware([Authenticate::class])->group(function () {

	Route::get('verify_account', function () {
		$randNadraData = DB::table('nadra_cnic')->inRandomOrder()->limit(3)->get()->all();
		$nadraDataOfCurrentUser = DB::table('nadra_cnic')->where('cnic', '=', Auth::user()->cnic)->get()->all();
		$mergedNadraData = array_merge($nadraDataOfCurrentUser , $randNadraData);
		shuffle($mergedNadraData);
		return view('verify_account', ['nadra_data' => $mergedNadraData]);
	});

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
