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
		Schema::create('elections_meta', function (Blueprint $table) {
			$table->id();
			$table->string('meta_key');
			$table->string('meta_value');
			$table->timestamps();
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
