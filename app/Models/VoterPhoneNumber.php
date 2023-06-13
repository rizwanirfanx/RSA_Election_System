<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoterPhoneNumber extends Model
{
	use HasFactory;
	protected $table = 'voter_phone_numbers';
	protected $fillable = ['phone_number', 'user_id'];
}
