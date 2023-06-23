<?php

namespace App\Http\Controllers;

use App\Models\NA_Candidates;
use App\Models\NadraDB;
use App\Models\NAVote;
use App\Models\PA_Candidate;
use App\Models\PA_Vote;
use App\Models\User;
use App\Models\User_Meta;
use App\Models\Vote;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class VoterController extends Controller
{
	//
	public function displayVotePage(Request $request)
	{
		$voter_nadra_info = DB::table('nadra_cnic')->where('cnic', '=', Auth::user()->cnic)->get();

		if (count($voter_nadra_info) > 0) {
			$voter_nadra_info = $voter_nadra_info[0];
		} else {
		}

		return view('voting_page', ['voter_nadra_info' => $voter_nadra_info]);
	}



	public function verifyVotingPass(Request $request)
	{

		if (Auth::user()->meta_data()->where('meta_key', 'voting_pass_verified')->first() != null) {
			ddd("Already Verified");
		}
		$voting_pass = Auth::user()->meta_data()
			->where('meta_key', 'voting_pass')->first()->meta_value;

		$user_provided_vp = $request->all()["voter_pass"];

		if (
			$user_provided_vp == $voting_pass
			&&
			Auth::user()->cnic == $request->cnic
		) {

			$voting_pass_verified = new User_Meta(
				[
					'user_id' => Auth::user()->getAuthIdentifier(),
					'meta_key' => 'voting_pass_verified',
					'meta_value' => True
				]
			);
			Auth::user()->meta_data()->save(
				$voting_pass_verified
			);
			return view('verification_successful', [
				'title' => 'Voter Pass Verified Successfully',
				'description' => 'Congratulations, ' . Auth::user()->name .
					' you voter pass has been successfully verified, Now you can vote for your favorite candidate!',
			]);
		} else {
			return view('error_page', [
				'error_title' => 'Invalid Voting Pass',
				'error_message' => "Try Again, If it doesn't work then Re-generate your voting pass"
			]);
		}
		redirect('/voter-verification');
	}


	public function castNAVote(Request $request)
	{

		$userVoted = NAVote::where('voter_id', Auth::user()->id)->first();
		if ($userVoted != null) {
			return view('error_page',  ['error_title' => 'Already Casted NA Vote', 'error_message' => 'You have already casted your vote']);
		}

		$request_body = $request->all();
		NAVote::create([
			'voter_id' => Auth::user()->getAuthIdentifier(),
			'candidate_id' => $request_body["candidate_id"],
			'na_constituency_number' => $request_body["candidate_constituency"],
		]);
		$candidate = NA_Candidates::find($request_body["candidate_id"]);
		return view(
			'verification_successful',
			[
				'title' => 'NA Vote Casted Successfully',
				'description' => 'You successfully casted your vote for ' .
					$candidate->name .  ', constituency, ' . $request_body['candidate_constituency']
			]
		);
	}

	public function castPAVote(Request $request)
	{
		$userVoted = PA_Vote::where('voter_id', Auth::user()->getAuthIdentifier())->first();
		if ($userVoted != null) {
			return view('error_page',  ['error_title' => 'Already Casted PA Vote', 'error_message' => 'You have already casted your vote']);
		}
		$request_body = ($request->all());
		PA_Vote::create([
			'voter_id' => Auth::user()->getAuthIdentifier(),
			'candidate_id' => $request_body["candidate_id"],
			'pa_code' => $request_body["pa_code"],
		]);
		return view('verification_successful', [
			'title' => 'PA Vote Casted Successfully',
			'description' => 'You have successfully casted your PA Vote',
		]);
	}
	public function index()
	{
		$voters = User::all();
		foreach ($voters as $voter) {
			ddd($voter->meta_data()->where('user_id', $voter->id)
				->where('meta_key', 'is_verified')
				->orWhere('meta_key', 'user_role')->get());
		}
		return view(
			'ecp.display_voters',
			[
				'voters' =>  Voter::all(),

			]

		);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		//
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


		return view('voter.display_results', [
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
		return view('voter.na_constituency_result_details', [
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
		return view('voter.na_constituency_result_details', [
			'party_votes' => $party_votes,
		]);
	}
}
