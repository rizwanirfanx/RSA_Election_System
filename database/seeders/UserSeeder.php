<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\User_Meta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$user = User::create(
			[
				'name' => 'admin',
				'email' => 'ecp@rsa.gov.pk',
				'password' => Hash::make('password'),
				'phone_number' => '00000000000',
				'cnic' => '00000-0000000-0',
			]
		);
		User_Meta::create(
			[
				'user_id' => $user->id,
				'meta_key' => 'user_role',
				'meta_value' => 'admin',
			]
		);
	}
}
