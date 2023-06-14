<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ElectionMeta;

class EnsureElectionIsInProgress
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next): Response
	{
		$election_starting_time = ElectionMeta::where('meta_key', 'election_starting_time')
			->first();
		ddd($election_starting_time);
		return $next($request);
	}
}
