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
		Schema::table('pa_candidates', function (Blueprint $table) {
			$table->dropColumn(
				[
					'c_CNIC',
					'c_first_name',
					'c_last_name',
					'party_id',
					'pa_seat_id'
				]
			);
			$table->string('name');
			$table->string('cnic')->unique();
			$table->string('address');
			$table->string('constituency_number');
			$table->string('party_symbol_number');
		});
		//
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		//
	}
};
