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
		Schema::create('pa_seats', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('ps_constituency')->unique();
			$table->string('ps_area_name');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('pa_seats');
	}
};
