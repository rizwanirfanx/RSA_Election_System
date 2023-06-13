<?php

namespace App\Http\Middleware;

use App\Models\PA_Vote;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsurePAVoteNotCasted
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next): Response
	{
		$castedNAVote = PA_Vote::where('voter_id', Auth::user()->getAuthIdentifier())->first();
		if ($castedNAVote != null) {
			return response(
				view(
					'error_page',
					[
						'error_title' => 'PA Vote Already Casted',
						'error_message' => 'You have Already Casted your Provincial Assembly Vote'
					]
				)
			);
		}
		return $next($request);
	}
}
