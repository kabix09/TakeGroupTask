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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('original_title');
            $table->text('overview');
            $table->string('original_language');
            $table->date('release_date');
            $table->string('poster_path');
            $table->string('backdrop_path');
            $table->float('popularity')->default(0);
            $table->float('vote_average')->default(0);
            $table->integer('vote_count')->default(0);
            $table->boolean('adult')->default(false);
            $table->boolean('video')->default(false);
            $table->unsignedBigInteger('tmdb_id')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
