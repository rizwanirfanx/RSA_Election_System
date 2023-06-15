<?php

namespace App\Http\Controllers;

use App\Models\NadraDB;
use App\Models\NAVote;
use App\Models\PA_Candidate;
use App\Models\PA_Vote;
use App\Models\User;
use App\Models\User_Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

		if ($user_provided_vp == $voting_pass) {

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
			return view('verification_successful');
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
	}
}
