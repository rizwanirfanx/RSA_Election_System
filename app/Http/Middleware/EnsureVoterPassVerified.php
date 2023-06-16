<?php

namespace App\Http\Middleware;

use App\Models\User_Meta;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class EnsureVoterPassVerified
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next): Response
	{
		$voting_pass_verified = Auth::user()->meta_data()
			->where('meta_key', 'voting_pass_verified')->where('meta_value', '1')
			->first();
		if ($voting_pass_verified != null) {

			return $next($request);
		}
		return response(view('error_page', [
			'error_title' => 'Voting Pass Not Verified',
			'error_message' => "Please Verify your Voting Pass Before Casting Vote",
		]));
	}
}
