<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('pa_candidates', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('c_CNIC');
			$table->string('c_first_name');
			$table->string('c_last_name');
			$table->foreignId('party_id');
			$table->foreignId('pa_seat_id');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('pa_candidates');
	}
};
