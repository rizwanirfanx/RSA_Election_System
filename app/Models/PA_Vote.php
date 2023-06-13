<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PA_Vote extends Model
{
	use HasFactory;
	protected $table = 'pa_votes';
	protected $fillable = ['voter_id', 'candidate_id', 'pa_code'];
}
