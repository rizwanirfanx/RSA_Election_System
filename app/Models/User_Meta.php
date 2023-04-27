<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Meta extends Model
{
	protected $fillable = ['meta_key', 'meta_value'];
	use HasFactory;
}
