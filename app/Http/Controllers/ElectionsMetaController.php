<?php

namespace App\Http\Controllers;

use App\Models\ElectionMeta;
use DateTime;
use Illuminate\Http\Request;

class ElectionsMetaController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		//
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

		$electionTiming = (ElectionMeta::where('meta_key', 'starting_time')->first());
		if ($electionTiming != null) {
			return view('ecp.error_page', [
				'error_title' => 'Election Timing Has Already Been Set',
				'error_message' => "The Election Timing Has Already Been Set!",
			]);
		} else {
		}
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
}
