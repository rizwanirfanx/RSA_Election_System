<?php

namespace App\Http\Controllers;

use App\Models\ElectionMeta;
use App\Models\NA_Candidates;
use App\Models\NA_Seat;
use App\Models\NadraDB;
use App\Models\NaSeat;
use App\Models\NAVote;
use App\Models\PA_Candidate;
use App\Models\PA_Seat;
use App\Models\Party;
use App\Models\User;
use App\Models\User_Meta;
use App\Models\Vote;
use App\Models\VoterPhoneNumber;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ECPController extends Controller
{
	public function setElectionTime(Request $request)
	{
		$starting_time = DateTime::createFromFormat("Y-m-d", $request->election_starting_time);
		$ending_time = DateTime::createFromFormat("Y-m-d", $request->election_ending_time);
		$diff = $starting_time->diff($ending_time);
		if ($diff->invert === 0) {
			ElectionMeta::create([
				'meta_key' => 'starting_time',
				'meta_value' => $starting_time,
			]);
			ElectionMeta::create([
				'meta_key' => 'ending_time',
				'meta_value' => $ending_time,
			]);
			return view(
				'ecp.success_page',
				[
					'title' => 'Election Timing Has been set successfully',
					'description' => "Election Timing has been set successfully, The Elections will start on "
						. $request->election_starting_time .
						" & Elections will end on " . $request->election_ending_time,
				]
			);
		}
		return view('ecp.error_page', [
			'error_title' => 'Invalid Timing',
			'error_message' => "The Election cannot be Stopped before it starts!",
		]);
	}

	//
	public function uploadElectionCandidatesCSV(Request $request)
	{
		$candidatesFile = $request->file('candidates_csv');
		if ($candidatesFile->extension() != "csv") {
			ddd('Invalid Type of Data Passed');
		}

		$file = fopen($candidatesFile, "r");
		$parties = array();
		$i = 0;
		// The following Loop will remove unneccessary columns 
		// from Constituency Data
		while (($data = fgetcsv($file)) != false) {
			if ($i == 0) {
				$i++;
			} else {
				$temp_array = array("province" => $data[1], "constituency_number" => $data[2], "constituency_name" =>  $data[3]);
				array_push($parties, $temp_array);
			}
		}
		fclose($file);
		$constituency = "";
		$unique_constituency = array();
		// This loop only select unique Constituency  
		foreach ($parties as $party) {
			if ($party['constituency_number'] != $constituency) {
				array_push($unique_constituency, $party);
				$constituency = $party['constituency_number'];
			}
		}
		DB::table('na_seats')->insert($unique_constituency);

		return $candidatesFile;
	}

	public function uploadPoliticalParties(Request $request)
	{
		$file = $request->file('parties_csv');
		$file = fopen($file, "r");
		$i = 0;

		$parties = array();
		while (($data = fgetcsv($file)) != false) {
			if ($i == 0) {
				$i++;
			} else {
				$temp_array = array("p_name" => $data[0], "p_sign" => $data[2], "p_symbol_number" => $data[3], "created_at" => Date::now(), "updated_at" => Date::now());
				array_push($parties, $temp_array);
			}
		}
		DB::table('party')->insert($parties);
		ddd("DONE");
	}

	public function uploadNAConstituency(Request $request)
	{
	}

	public function displayParties(Request $request)
	{

		$parties = (DB::table('party')->select()->get());

		return view('ecp.parties', [
			'parties' => $parties
		]);
	}


	public function displayNACandidatesPage(Request $request)
	{
		$candidates = DB::table('na_candidates')->join('party', 'na_candidates.party_symbol_number', '=', 'p_symbol_number')->select('na_candidates.*', 'party.p_name')->get();
		return view('ecp.na_candidates', [
			'candidates' => $candidates
		]);
	}

	public function displayAddCandidatePage(Request $request)
	{
		$na_constituencies = DB::table('na_seats')->select()->get();
		$parties = DB::table('party')->select()->get();
		return view(
			'ecp.add_candidate',
			[
				'na_constituencies' => $na_constituencies,
				'parties' => $parties
			]
		);
	}
	public function addNACandidate(Request $request)
	{
		$request->validate(

			[
				'name' => 'required',
				'cnic' => 'required|unique:App\Models\NA_Candidates',
				'constituency_number' => 'required',
				'address' => 'required',
				'party_symbol_number' => 'required',

			]

		);
		$constituency = $request->constituency_number;
		$party = $request->party_symbol_number;
		$candidateExists = NA_Candidates::where('party_symbol_number', $party)
			->where('constituency_number', $constituency)
			->first();
		if ($candidateExists != null) {
			//			return view(
			//				'ecp.error_page',
			//				[
			//					'error_title' => 'Existing Candidate',
			//					'error_message' => 'Candidate from this party Already Exists',
			//				]
			//			);

			return Redirect::back()->withErrors(
				[
					'existing_candidate' => 'Candidate Already Exists for ' . $constituency
						. ' from Party ' . $party,
				]
			);
		}


		$new_na_candidate = new NA_Candidates;
		$new_na_candidate->name = $request->name;
		$new_na_candidate->constituency_number = $request->constituency_number;
		$new_na_candidate->address = $request->address;
		$new_na_candidate->party_symbol_number = $request->party_symbol_number;
		$new_na_candidate->cnic = $request->cnic;
		$isSavedSuccessfully = $new_na_candidate->save();
		if ($isSavedSuccessfully) {
			return view('ecp.success_page', [
				'title' => 'NA Candidate Added!',
				'description' => 'National Assembly Candidate ' .
					$request->name . ' has been added Successfully for NA Seat '
					. $request->constituency_number,
			]);
		}
	}

	public function displayAddNASeatPage()
	{
		return view('ecp.add_na_seat');
	}

	public function addNASeat(Request $request)
	{
		$request->validate(
			[
				'constituency_number' => 'required|unique:App\Models\NA_Seat',
				'constituency_name' => 'required'
			]
		);
		NA_Seat::create(
			[
				'constituency_name' => $request->constituency_number,
				'constituency_name' => $request->constituency_name,
			]
		);
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


		return view('ecp.display_results', [
			'results' => $results,
			'pa_results' => $results_of_pa,
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
		return view('ecp.na_constituency_result_details', [
			'party_votes' => $party_votes,
		]);
	}
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
		return view('ecp.na_constituency_result_details', [
			'party_votes' => $party_votes,
		]);
	}

	function displayLoginPage()
	{
		return view('ecp.login');
	}

	function authenticateECPAdmin(Request $request)
	{

		$credentials = $request->validate([
			'email' => ['required', 'email'],
			'password' => ['required', 'min:8'],
		]);


		if (Auth::attempt($credentials)) {
			$current_user_id = Auth::user()->getAuthIdentifier();
			$role = User_Meta::where('user_id', $current_user_id)->where('meta_key', 'user_role')->first();
			if ($role != null && $role->meta_value == 'admin') {
				$request->session()->regenerate();
				return redirect()->intended('/admin/dashboard');
			}
		}
		return back()->withErrors([
			'email' => 'The provided credentials do not match our records.',
		])->onlyInput('email');
	}
	public function displayNADRAPage()
	{
		$pa_seats = PA_Seat::all(['ps_constituency', 'ps_area_name']);
		$na_seats = NA_Seat::all(['constituency_number', 'constituency_name']);

		return view(
			'ecp.add_nadra_verification_details',
			[
				'pa_constituencies' => $pa_seats,
				'na_constituencies' => $na_seats,
			]
		);
	}

	public function addNADRADetails(Request $request)
	{
		$request->validate(
			[
				'cnic' => 'required|unique:App\Models\NadraDB',
				'mother_name' => 'required',
				'cnic_expiry_date' => 'required',
				'na_constituency_number' => 'required',
				'pa_constituency_number' => 'required',
				'phone_number' => 'required|unique:App\Models\VoterPhoneNumber',
			]
		);

		$user = NadraDB::create(
			[
				'cnic_expiry_date' => $request->cnic_expiry_date,
				'mother_name' => $request->mother_name,
				'cnic' => $request->cnic,
				'na_constituency_number' => $request->na_constituency_number,
				'pa_constituency_number' => $request->pa_constituency_number,
				'name' => $request->name,
			]
		);
		VoterPhoneNumber::create(
			[
				'phone_number' => $request->phone_number,
				'cnic' => $user->cnic,
			]
		);
	}
	public function displayAddPACandidatePage()
	{

		return view('ecp.add_pa_candidate', [
			'parties' => Party::all(),
			'pa_constituencies' => PA_Seat::all(),

		]);
	}

	public function addPACandidate(Request $request)
	{
		$request->validate(
			[
				'name' => 'required',
				'cnic' => 'required|unique:App\Models\PA_Candidate',
				'address' => 'required',
				'constituency_number' => 'required',
				'party_symbol_number' => 'required',
			]
		);

		$memberExists =
			PA_Candidate::where('party_symbol_number', $request->party_symbol_number)
			->where('constituency_number', $request->constituency_number)
			->first();

		if ($memberExists != null) {
			return view('ecp.error_page', [
				'error_title' => 'Candidate Already Exists',
				'error_message' => 'Candidate ' . $request->name .
					' with CNIC ' . $request->cnic  .
					' already exists in PA Constituency ' .  $request->constituency_number,
			]);
		}


		PA_Candidate::create([
			'name' => $request->name,
			'cnic' => $request->cnic,
			'address' => $request->address,
			'constituency_number' => $request->constituency_number,
			'party_symbol_number' => $request->party_symbol_number,
		]);

		return view(
			'ecp.success_page',
			[
				'title' => 'PA Member Added',
				'description' => 'PA Member ' . $request->name . ' has been successfully added in ' . $request->constituency_number,
			]
		);
	}

	public function displayPACandidates()
	{
		$candidates = DB::table('pa_candidates')
			->join('party', 'party_symbol_number', '=', 'p_symbol_number')
			->select('pa_candidates.*', 'party.p_name')->get();
		return view('ecp.pa_candidates', [
			'candidates' => $candidates
		]);
	}
	public function displayAddPASeatPage()
	{
		return view('ecp.add_pa_seat');
	}
	public function addPASeat(Request $request)
	{
		$request->validate(
			[
				'ps_area_name' => 'required|unique:App\Models\PA_Seat',
				'ps_constituency' => 'required|unique:App\Models\PA_Seat',
				'province' => 'required'
			]
		);
		PA_Seat::create(
			[
				'ps_constituency' => $request->ps_constituency,
				'ps_area_name' => $request->ps_area_name,
				'province' => $request->province,
			]
		);
		return view('ecp.success_page', [
			'title' => 'Provincial Assembly Seat Added!',
			'description' => "Provincial Assembly Seat for Area " . $request->ps_area_name .
				" has been added succesfully",
		]);
	}
	public function displayPASeats()
	{
		return view('ecp.pa_seats', [
			'pa_seats' => PA_Seat::all(),
		]);
	}
	public function displayNASeats()
	{
		return view('ecp.na_seats', [
			'na_seats' => NA_Seat::all(),
		]);
	}
}
