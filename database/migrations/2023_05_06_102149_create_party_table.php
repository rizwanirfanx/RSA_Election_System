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
		Schema::table('party', function (Blueprint $table) {
			$table->string('p_symbol_number');
		});
	}
	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('party', function (Blueprint $table) {
			$table->dropColumn('p_symbol_number');
		});
	}
};
