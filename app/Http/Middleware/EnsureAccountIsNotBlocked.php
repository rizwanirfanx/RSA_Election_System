<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountIsNotBlocked
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next): Response
	{

		$account_blocked = (Auth::user()->meta_data()->where('meta_key', 'account_blocked')->first());
		if ($account_blocked == null) {
			return $next($request);
		}
		return response(view('error_page', [
			'error_title' => 'Your Account is Blocked',
			'error_message' => 'Your Account has been blocked due to Suspicious Activity, if you are the rightful owner of this account then contact site admin at rizwanirfanx@gmail.com',
		]));
	}
}
