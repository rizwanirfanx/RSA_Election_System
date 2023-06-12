<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PA_Seat extends Model
{
	protected $table = 'pa_seats';
	protected $fillable = ['ps_constituency', 'ps_area_name', 'province'];
	use HasFactory;
}
