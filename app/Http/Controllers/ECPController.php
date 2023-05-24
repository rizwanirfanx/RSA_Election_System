<?php

namespace App\Http\Controllers;

use App\Models\NaSeat;
use Illuminate\Http\Request;
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

	public function uploadNAConstituency(Request $request)
	{
	}
}
