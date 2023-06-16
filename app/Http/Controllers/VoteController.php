<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoteRequest;
use App\Http\Requests\UpdateVoteRequest;
use App\Models\NadraDB;
use App\Models\User;
use App\Models\Vote;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VoteController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('ecp.upload_dummy_voters');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$file = $request->file('dummy_voters');
		$row = 1;
		if (($handle = fopen($file, "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 100, ",")) !== FALSE) {
				if ($row == 1) {
					$row++;
					continue;
				}
				$num = count($data);
				for ($c = 0; $c < 1; $c++) {
					$dateString = $data[5];
					$date = DateTime::createFromFormat('m/d/Y H:i', $dateString);
					$mysqlDate = $date->format('Y-m-d H:i:s');

					echo "<p>" . $data[0] . "</p>";
					//					NadraDB::create(
					//						[
					//							'cnic' => $data[0],
					//							'mother_name' => $data[4],
					//							'cnic_expiry_date' => $mysqlDate,
					//							'na_constituency_number' => $data[6],
					//							'pa_constituency_number' => $data[7],
					//							'name' => $data[3],
					//						],
					//					);
					//					User::create([
					//						'cnic' => $data[0],
					//						'email' => $data[1],
					//						'phone_number' => $data[2],
					//						'name' => $data[3],
					//						'password' => Hash::make($data[8]),
					//					]);
				}
				$row++;
			}
			fclose($handle);
		}
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Vote $vote)
	{
		ddd("BUT WHY");
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Vote $vote)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateVoteRequest $request, Vote $vote)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Vote $vote)
	{
		//
	}
}
