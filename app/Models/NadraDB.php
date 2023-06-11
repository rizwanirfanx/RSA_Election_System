<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NadraDB extends Model
{
	use HasFactory;

	protected $table = 'nadra_cnic';
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
