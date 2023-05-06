<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\isEmpty;

class EnsureUserIsECPAdmin
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next): Response
	{
		$is_admin = DB::table('users_meta')
			->where('meta_key', '=', 'user_role')
			->where('meta_value', '=', 'admin')
			->where('user_id', '=', Auth::user()->id)
			->get();
		// The following conditgion could be problematic, because we are checking the size of collection 
		// to guess whether the user is logged in as admin or not
		if (sizeof($is_admin) > 0) {
			return $next($request);
		}
		return abort(403);
	}
}
