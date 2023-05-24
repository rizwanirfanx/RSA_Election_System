<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\User_Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	public function store(Request $request)
	{
		$validated = $request->validate([
			'name' => 'required',
			'email' => 'required|email|unique:App\Models\User',
			'password' => 'required|min:8|max:255',
			'cnic' => 'required|min:13|max:15|unique:users',
			'phone_number' => 'required|min:9|max:14|unique:users',

		]);

		$hashedPassword = Hash::make($request->password);

		$user = new User;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = $hashedPassword;
		$user->cnic = $request->cnic;
		$user->phone_number = $request->phone_number;
		$user->save();
		return redirect('/');
	}

	public function verify_account(Request $request)
	{

		$nadraDataOfCurrentUser = DB::table('nadra_cnic')->where('cnic', '=', Auth::user()->cnic)->get()->all();
		
		if ($nadraDataOfCurrentUser[0]->mother_name == $request->mother_name) {
			$user_meta = new User_Meta;
			$user_meta->meta_key = 'is_verified';
			$user_meta->meta_value = true;
			$user_meta->user_id = Auth::user()->getAuthIdentifier();
			$user_meta->save();
			return redirect('/verification_successful');
			
		} else {
			ddd($nadraDataOfCurrentUser == $request->mother_name);
		}
	}
}
