<?php

namespace App\Http\Controllers;

use App\Models\ElectionMeta;
use App\Models\NA_Candidates;
use App\Models\PA_Candidate;
use App\Models\User;
use App\Models\User_Meta;
use App\Models\VoterPhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class UserController extends Controller
{

	function displayIndividualPAResult(Request $request, $pa_code)
	{
		$party_votes = (DB::table('pa_votes')
			->groupBy('candidate_id')
			->groupBy('pa_code')
			->groupBy('party_symbol_number')
			->groupBy('name')
			->select(
				DB::raw('count(*) as number_of_votes, candidate_id, name,  pa_code , pa_candidates.party_symbol_number')
			)->where('pa_code', $pa_code)
			->join('pa_candidates', 'candidate_id', 'pa_candidates.id')->orderByDesc('number_of_votes')
			->get());
		return view('na_constituency_result_details', [
			'party_votes' => $party_votes,
		]);
	}
	function displayIndividualNAResult(Request $request, $na_constituency_number)
	{
		$party_votes = (DB::table('na_votes')
			->groupBy('candidate_id')
			->groupBy('na_constituency_number')
			->groupBy('party_symbol_number')
			->groupBy('name')
			->select(
				DB::raw('count(*) as number_of_votes, candidate_id, name,  na_constituency_number , na_candidates.party_symbol_number')
			)->where('na_constituency_number', $na_constituency_number)
			->join('na_candidates', 'candidate_id', 'na_candidates.id')->orderByDesc('number_of_votes')
			->get());
		return view('na_constituency_result_details', [
			'party_votes' => $party_votes,
		]);
	}
	public function displayResults()
	{
		$voteCounts = DB::table('na_votes')
			->select('candidate_id', DB::raw('COUNT(*) as vote_count'))
			->groupBy('candidate_id')
			->get();

		$subquery = DB::table(function ($query) {
			$query->select(
				'na_constituency_number',
				'candidate_id',
				DB::raw('COUNT(*) AS occurrences'),
				DB::raw('ROW_NUMBER() OVER (PARTITION BY na_constituency_number ORDER BY COUNT(*) DESC) AS rn')
			)
				->from('na_votes')
				->groupBy('na_constituency_number', 'candidate_id');
		}, 'subquery');

		$subquery_for_pa = DB::table(function ($query) {
			$query->select(
				'pa_code',
				'candidate_id',
				DB::raw('COUNT(*) AS occurrences'),
				DB::raw('ROW_NUMBER() OVER (PARTITION BY pa_code ORDER BY COUNT(*) DESC) AS rn')
			)
				->from('pa_votes')
				->groupBy('pa_code', 'candidate_id');
		}, 'subquery');

		$results_of_pa =
			DB::table($subquery_for_pa)
			->where('rn', 1)
			->select('pa_code', 'candidate_id')
			->get();

		$results = DB::table($subquery)
			->where('rn', 1)
			->select('na_constituency_number', 'candidate_id')
			->get();

		foreach ($results as $result) {
			$candidate_info = NA_Candidates::find($result->candidate_id);
			$result->winner_name = $candidate_info->name;
			$result->party_symbol_number = $candidate_info->party_symbol_number;
		}
		foreach ($results_of_pa as $result) {
			$candidate_info = PA_Candidate::find($result->candidate_id);
			$result->winner_name = $candidate_info->name;
			$result->party_symbol_number = $candidate_info->party_symbol_number;
		}


		return view('display_results', [
			'results' => $results,
			'pa_results' => $results_of_pa,
		]);
	}
	public function store(Request $request)
	{
		$credentials = $request->validate([
			'name' => 'required',
			'email' => 'required|email|unique:App\Models\User',
			'password' => 'required|min:8|max:255',
			'cnic' => 'required|min:13|max:15|unique:users',
			'phone_number' => 'required|min:9|max:14|unique:users',

		]);

		$voter_phone_numbers = (VoterPhoneNumber::where('cnic', $request->cnic)->first());

		//		if ($voter_phone_numbers == null) {
		//			$error = new MessageBag();
		//			$error->add('phone_number_error', 'No Phone Number Registered on your CNIC');
		//			return view('registration_page')->withErrors($error);
		//		}



		$hashedPassword = Hash::make($request->password);

		$user = new User;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = $hashedPassword;
		$user->cnic = $request->cnic;
		$user->phone_number = $request->phone_number;
		$user->save();
		if (Auth::attempt($credentials)) {
			$request->session()->regenerate();

			return redirect()->intended('/profile');
		}

		return redirect('/login');
	}

	public function verify_account(Request $request)
	{

		$nadraDataOfCurrentUser = DB::table('nadra_cnic')->where('cnic', '=', Auth::user()->cnic)->get()->all();

		$user_meta = new User_Meta;
		$user_meta->user_id = Auth::user()->getAuthIdentifier();
		if (
			$nadraDataOfCurrentUser[0]->mother_name == $request->mother_name
			&&
			$nadraDataOfCurrentUser[0]->cnic_expiry_date == $request->cnic_expiry_date
		) {
			$user_meta->meta_key = 'is_verified';
			$user_meta->meta_value = true;
			$user_meta->save();
			return view('verification_successful', [
				'title' => 'Verificaiton Successful',
				'description' => 'Your Account has been successfully verified, now you can cast your vote for your favorite canddiate',
			]);
		} else {
			$user_meta->meta_key = 'account_blocked';
			$user_meta->meta_value = true;
			$user_meta->save();
			return view('error_page', [
				'error_message' => 'Your Account has been Blocked',
				'error_title' => 'Account Blocked',
			]);
		}
	}
	public function displayVerifyAccountPage(Request $request)
	{


		$nadraDataOfCurrentUser = DB::table('nadra_cnic')->where('cnic', '=', Auth::user()->cnic)->get()->all();
		$curr_user_mother_name = ($nadraDataOfCurrentUser[0]->mother_name);
		$randNadraData = DB::table('nadra_cnic')->where('mother_name', '!=', $curr_user_mother_name)->inRandomOrder()->limit(3)->get()->all();
		$mergedNadraData = array_merge($nadraDataOfCurrentUser, $randNadraData);
		shuffle($mergedNadraData);
		//		ddd(VoterPhoneNumber::where('user_id', Auth::user()->getAuthIdentifier())->get());
		return view('verify_account', ['nadra_data' => $mergedNadraData]);
	}
	public function displayProfilePage(Request $request)
	{

		$user_voting_pass = Auth::user()->meta_data()->where('meta_key', 'voting_pass')->first()?->meta_value;

		$user_verification_status = Auth::user()->meta_data()->where('meta_key', 'is_verified')->first();

		$starting_time = ElectionMeta::where('meta_key', 'starting_time')->first()
			?->meta_value;
		$ending_time = ElectionMeta::where('meta_key', 'ending_time')->first()
			?->meta_value;


		return view(
			'profile_page',
			[
				'user' => Auth::user(),
				'user_verification_status' => $user_verification_status,
				'voter_pass' => $user_voting_pass,
				'election_starting_time' => $starting_time,
				'election_ending_time' => $ending_time,

			]
		);
	}
}
