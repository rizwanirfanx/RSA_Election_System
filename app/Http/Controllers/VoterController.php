<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoterController extends Controller
{
    //
	public function displayVotePage(Request $request){
		$voter_nadra_info = DB::table('nadra_cnic')->where('cnic' , '=', Auth::user()->cnic)->get();

		if(count($voter_nadra_info) > 0){
			$voter_nadra_info = $voter_nadra_info[0];
		}
		else{
		}
		
		return view('voting_page', ['voter_nadra_info' => $voter_nadra_info]);
	}


	public function displayCandidatesPage(){

	}
}
