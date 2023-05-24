<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class User_Meta extends Model
{
	protected $table = 'users_meta';
	protected $fillable = ['meta_key', 'meta_value', 'user_id'];
	use HasFactory;
}
