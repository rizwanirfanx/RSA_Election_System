<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountIsVerified
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next): Response
	{
		$user = Auth::user();
		$is_verified = ($user->meta_data()->where('meta_key', 'is_verified')
			->where('meta_value', 1)->first());
		if ($is_verified == null) {
			return response(
				view(
					'error_page',
					[
						'error_title' => 'Please Verify Your Account First',
						'error_message' => "Please Go ANd Verify Your Account by Entering your Mother Name & CNIC",
					]
				)
			);
		}
		return $next($request);
	}
}
