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
        Schema::create('na_votes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
	    $table->foreignId('candidate_id');
	    $table->foreignId('voter_id');
	    $table->string('na_constituency_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('na_votes');
    }
};
