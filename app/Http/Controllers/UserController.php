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
}
