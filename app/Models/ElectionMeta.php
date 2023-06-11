<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionMeta extends Model
{
	protected $fillable = ['meta_key', 'meta_value'];
	protected $table = 'elections_meta';
	use HasFactory;
}
