<?php

namespace App\Http\Controllers;

use App\Models\NA_Candidates;
use App\Models\NaSeat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class ECPController extends Controller
{
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
		$candidates = DB::table('na_candidates')->join('party', 'na_candidates.party_symbol_number', '=', 'p_symbol_number' )->select('na_candidates.*' , 'party.p_name')->get();
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
		$new_na_candidate = new NA_Candidates;
		$new_na_candidate->name = $request->name;
		$new_na_candidate->constituency_number = $request->na_constituency;
		$new_na_candidate->address = $request->address;
		$new_na_candidate->party_symbol_number = $request->party_symbol_number;
		$isSavedSuccessfully = $new_na_candidate->save();
		if ($isSavedSuccessfully) {
			return view('verification_successful');
		}
	}
}
