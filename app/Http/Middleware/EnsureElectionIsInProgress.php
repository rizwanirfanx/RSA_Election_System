<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ElectionMeta;
use DateTime;

class EnsureElectionIsInProgress
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next): Response
	{
		next($request);
		$election_starting_time = ElectionMeta::where('meta_key', 'starting_time')->first();
		$election_ending_time = ElectionMeta::where('meta_key', 'ending_time')->first();


		if ($election_starting_time == null) {
			return response(
				view(
					'error_page',
					[
						'error_title' => 'Election Time Has Not Been Announced yet',
						'error_message' => 'Election Date Has Not Yet Been Finalized by ECP, You Will be Informed Via SMS or Email When the Voting Start',
					],
				),
			);
		}
		$est = DateTime::createFromFormat(
			'Y-m-d',
			$election_starting_time->meta_value,
		);
		$eet = DateTime::createFromFormat(
			'Y-m-d',
			$election_ending_time->meta_value
		);
		ddd($est);

		$diff = ($election_starting_time->diff($election_ending_time));
		ddd($diff);
		return $next($request);
	}
}
