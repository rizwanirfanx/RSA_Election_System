<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ECPController;
use App\Http\Controllers\ElectionsMetaController;
use App\Http\Controllers\NACandidateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\VotingPageController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\EnsureAccountIsVerified;
use App\Http\Middleware\EnsureElectionIsInProgress;
use App\Http\Middleware\EnsurePAVoteNotCasted;
use App\Http\Middleware\EnsureUserIsECPAdmin;
use App\Http\Middleware\EnsureVoterPassVerified;
use App\Http\Middleware\isRegisteredByNADRA;
use App\Mail\TestMails;
use App\Models\User_Meta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

Route::middleware([Authenticate::class, isRegisteredByNADRA::class])->group(function () {


	Route::get('/candidates', [VotingPageController::class, 'displayVotingPage']);

	Route::middleware([EnsurePAVoteNotCasted::class, EnsureElectionIsInProgress::class])->group(function () {

		Route::post('/cast_pa_vote', [VoterController::class, 'castPAVote']);

		Route::get('/cast_pa_vote', [VotingPageController::class, 'displayPAVotingPage']);
	});

	Route::middleware([EnsureAccountIsVerified::class])->group(function () {
		Route::get('/generate_voting_pass', function () {
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
	});


	Route::get('/verify_account', [UserController::class, 'displayVerifyAccountPage']);

	Route::post('/verify_account', [UserController::class, 'verify_account']);

	Route::get('/verify_voting_pass', function () {
		return view('voter_pass_verification');
	});

	Route::post('/verify_voting_pass', [VoterController::class, 'verifyVotingPass']);

	Route::get('/verification_successful', function () {
		return view('verification_successful');
	});
});

Route::middleware([Authenticate::class])->group(function () {

	Route::get('/', [UserController::class, 'displayProfilePage']);


	Route::get('/profile', [UserController::class, 'displayProfilePage']);
});
Route::middleware([Authenticate::class, EnsureUserIsECPAdmin::class])->prefix('admin')->group(function () {

	Route::middleware([EnsureElectionIsInProgress::class])->group(function () {
	});

	Route::get('/dashboard', function () {
		return view('admin_panel_home');
	});

	Route::get('/voters', [VoterController::class, 'index']);

	Route::get('/upload_candidates', function () {
		return view('ecp.upload_candidates');
	});

	Route::get('/settings', function () {
		return view('ecp.settings');
	});

	Route::get('/display_results/{na_constituency_number}', [ECPController::class, 'displayIndividualNAResult']);

	Route::get('/display_pa_results/{pa_code}', [ECPController::class, 'displayIndividualPAResult']);

	Route::post('/set_election_timing', [ElectionsMetaController::class, 'store']);


	Route::post('/upload_candidates', [ECPController::class, 'uploadElectionCandidatesCSV']);

	Route::get('/upload_parties', function () {
		return view('ecp.upload_parties');
	});

	Route::post('/upload_parties', [ECPController::class, 'uploadPoliticalParties']);

	Route::get('/parties', [ECPController::class, 'displayParties']);
	//
	// NA ROUTES
	//
	Route::get('/na_candidates', [ECPController::class, 'displayNACandidatesPage']);

	Route::get('/add_na_candidate', [ECPController::class, 'displayAddCandidatePage']);

	Route::post('/add_na_candidate', [ECPController::class, 'addNACandidate']);

	Route::delete('/na_candidate/{id}', [ECPController::class, 'deleteNACandidate']);

	Route::put('/na_candidate/{id}', [NACandidateController::class, 'update']);

	Route::get('/na_candidate/{id}/edit', [NACandidateController::class, 'edit']);

	Route::put('/na_candidate/{id}', [NACandidateController::class, 'update']);

	Route::get('/add_na_seat', [ECPController::class, 'displayAddNASeatPage']);

	Route::post('/add_na_seat', [ECPController::class, 'addNASeat']);

	Route::get('/display_na_seats', [ECPController::class, 'displayNASeats']);
	//
	// PA Routes
	//
	Route::get('/add_pa_candidate', [ECPController::class, 'displayAddPACandidatePage']);

	Route::post('/add_pa_candidate', [ECPController::class, 'addPACandidate']);

	Route::get('/pa_candidates', [ECPController::class, 'displayPACandidates']);
	//


	Route::get('/add_pa_seat', [ECPController::class, 'displayAddPASeatPage']);

	Route::post('/add_pa_seat', [ECPController::class, 'addPASeat']);

	Route::get('/display_pa_seats', [ECPController::class, 'displayPASeats']);


	Route::get('/display_results', [ECPController::class, 'displayResults']);

	Route::get('/add_nadra_verification_details', [ECPController::class,  'displayNADRAPage']);

	Route::post('/add_nadra_verification_details', [ECPController::class,  'addNADRADetails']);

	Route::get('/upload_dummy_voters', [VoteController::class,  'create']);

	Route::post('/upload_dummy_voters', [VoteController::class,  'store']);
});

Route::middleware([Authenticate::class, isRegisteredByNADRA::class,  EnsureVoterPassVerified::class])->group(function () {

	Route::get('/vote', [VoterController::class, 'displayVotePage']);

	Route::post('/cast_na_vote', [VoterController::class, 'castNAVote']);
});



Route::get('/', function () {
	if (Auth::check()) {
		$user = Auth::user();
		$is_admin = $user->meta_data()->where('meta_key', 'user_role')
			->where('meta_value', 'admin')
			->first();
		if ($is_admin) {
			return redirect('/admin/dashboard');
		}
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


Route::get('/test-email', function () {
	return view('test-email');
});


Route::post('/test-email', function () {
	Mail::to('rizwanirfanx@gmail.com')->send(new TestMails());
});
