<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NA_Candidates extends Model
{
	protected $table = 'na_candidates';
	protected $fillable = ['name', 'address', 'constituency_number', 'party_symbol_number', 'cnic'];
	use HasFactory;
}
