<?php

namespace App\Http\Controllers;

use App\Models\NA_Candidates;
use App\Models\PA_Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VotingPageController extends Controller
{
	public function displayVotingPage()
	{

		$current_user_na_const = Auth::user()->nadra_data->where('cnic', Auth::user()->cnic)->first()->na_constituency_number;
		$candidates = NA_Candidates::where('constituency_number', $current_user_na_const)->get();
		return view(
			'candidates',
			[
				'candidates' => $candidates,
			]
		);
	}

	public function displayPAVotingPage()
	{
		
		$current_user_pa_const = Auth::user()->nadra_data->where('cnic', Auth::user()->cnic)->first()->pa_constituency_number;
		$candidates = PA_Candidate::where('constituency_number', $current_user_pa_const)->get();
		return view(
			'pa_candidates',
			[
				'candidates' => $candidates,
			]
		);
	}

	//
}
