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
		Schema::create('voters', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('v_CNIC', 13)->unique();
			$table->string('v_phone_number')->unique();
			$table->string('v_mother_name');
			$table->date('v_card_issuance_date');
			$table->string('v_na_number');
			$table->string('pa_number');
			$table->string('v_voter_pass')->unique();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('voters');
	}
};
