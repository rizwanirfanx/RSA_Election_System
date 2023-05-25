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

	Route::get('/upload_parties', function () {
		return view('ecp.upload_parties');
	});

	Route::post('/upload_parties', [ECPController::class, 'uploadPoliticalParties']);

	Route::get('/parties', [ECPController::class, 'displayParties']);

	Route::get('/na_candidates', [ECPController::class, 'displayNACandidatesPage']);

	Route::get('/add_na_candidate', [ECPController::class, 'displayAddCandidatePage']);

	Route::post('/add_na_candidate', [ECPController::class, 'addNACandidate']);
});
Route::middleware([Authenticate::class])->group(function () {

	Route::get('verify_account', function () {
		$randNadraData = DB::table('nadra_cnic')->inRandomOrder()->limit(3)->get()->all();
		$nadraDataOfCurrentUser = DB::table('nadra_cnic')->where('cnic', '=', Auth::user()->cnic)->get()->all();
		$mergedNadraData = array_merge($nadraDataOfCurrentUser, $randNadraData);
		shuffle($mergedNadraData);
		return view('verify_account', ['nadra_data' => $mergedNadraData]);
	});

	Route::post('/verify_account', [UserController::class, 'verify_account']);

	Route::get('/voter-verification', function () {
		return view('voter_pass_verification');
	});

	Route::get('/verification_successful', function () {
		return view('verification_successful');
	});



	Route::get('/profile', function () {

		$user = DB::table('users')->where('id',  '=', Auth::user()->getAuthIdentifier())->select()->get();

		$user_verification_status = DB::table('users_meta')->where('user_id', '=', Auth::user()->getAuthIdentifier())->where('meta_key', '=', 'is_verified')->select(['meta_value'])->get();
		if (count($user_verification_status) == 0) {
			$user_verification_status = 0;
		} else {
			$user_verification_status = $user_verification_status[0]->meta_value;
		}
		return view('profile_page', ['user' => $user[0], 'user_verification_status' => $user_verification_status]);
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
