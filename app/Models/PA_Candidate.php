<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PA_Candidate extends Model
{
	use HasFactory;
	protected $table = 'pa_candidates';
	protected $fillable = [
		'cnic',
		'address',
		'constituency_number',
		'party_symbol_number',
		'name'
	];
}
