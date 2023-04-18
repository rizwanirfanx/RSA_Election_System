<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	public function store(Request $request)
	{
		$validated = $request->validate([
			'name' => 'required',
			'email' => 'required|email|unique:App\Models\User',
			'password' => 'required|min:8|max:255',
			'cnic' => 'unique:App\Models\User|required|size:13',
			'phone_number' => 'unique:App\Models\User|required',

		]);

		$hashedPassword = Hash::make($request->password);

		$user = new User;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = $hashedPassword;
		$user->save();
		return redirect('/');
	}
}
