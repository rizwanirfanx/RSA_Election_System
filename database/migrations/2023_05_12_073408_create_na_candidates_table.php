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
		Schema::table('na_candidates', function (Blueprint $table) {
			$table->string('name');
			$table->string('address');
			$table->foreignId('party_id');
			$table->foreignId('constituency_number');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('na_candidates');
	}
};
