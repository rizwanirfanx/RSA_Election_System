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
		Schema::create('party', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('p_name');
			$table->string('p_sign');
			$table->foreignId('leader_id');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('party');
	}
};
