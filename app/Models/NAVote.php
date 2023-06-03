<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NAVote extends Model
{
	use HasFactory;
	protected $fillable = ['voter_id', 'candidate_id' , 'na_constituency_number'];
	protected $table = 'na_votes';
}
