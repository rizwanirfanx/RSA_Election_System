<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ECPController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\VotingPageController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\EnsureUserIsECPAdmin;
use App\Http\Middleware\EnsureVoterPassVerified;
use App\Http\Middleware\isRegisteredByNADRA;
use App\Models\User;
use App\Models\User_Meta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

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

Route::middleware([Authenticate::class, isRegisteredByNADRA::class])->group(function () {

	Route::get('verify_account', [UserController::class, 'displayVerifyAccountPage']);

	Route::post('/verify_account', [UserController::class, 'verify_account']);

	Route::get('/voter-verification', function () {
		return view('voter_pass_verification');
	});

	Route::post('/verify_voting_pass', [VoterController::class, 'verifyVotingPass']);

	Route::get('/verification_successful', function () {
		return view('verification_successful');
	});
	Route::post('/generate_voting_pass', function () {
		$voting_pass =  Hash::make(Auth::user()->email_address);
		$new_user_meta = new User_Meta;
		$new_user_meta->meta_key = 'voting_pass';
		$new_user_meta->meta_value = $voting_pass;
		$new_user_meta->user_id = Auth::user()->getAuthIdentifier();
		if ($new_user_meta->save()) {
			return redirect('/profile');
		}
		return response()->json(['message' => 'Failed to save the model'], 500);
	});
	Route::get('/candidates', [VotingPageController::class, 'displayVotingPage']);
});

Route::middleware([Authenticate::class])->group(function () {

	Route::get('/', [UserController::class, 'displayProfilePage']);


	Route::get('/profile', [UserController::class, 'displayProfilePage']);
});
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

	Route::get('/display_results', [ECPController::class, 'displayResults']);
});

Route::middleware([Authenticate::class, isRegisteredByNADRA::class,  EnsureVoterPassVerified::class])->group(function () {
	Route::get('/vote', [VoterController::class, 'displayVotePage']);
	Route::post('/cast_na_vote', [VoterController::class, 'castNAVote']);
});



Route::get('/', function () {
	if (Auth::check()) {
		return redirect('/profile');
	}
	return view('welcome');
});

Route::get('/admin', [ECPController::class, 'displayLoginPage']);
Route::post('/admin/login', [ECPController::class, 'authenticateECPAdmin']);


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
Route::get('/about-us', function () {
	return view('about_us');
});

Route::get('/nadra-error', function () {
	return view('error_page');
});
Route::get('/sms_simulator', function () {
	return view('sms_simulator');
});
