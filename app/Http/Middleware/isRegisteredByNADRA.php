<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isRegisteredByNADRA
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next): Response
	{

		if (Auth::user()->nadra_data()->first() != null) {
			return	$next($request);
		}


		return response(
			view(
				'error_page',
				[
					'error_title' => 'NADRA Record Not Found',
					'error_message' => 'You have not been registered by NADRA for online voting yet, kindly check back later',
				]
			)
		);
	}
}
