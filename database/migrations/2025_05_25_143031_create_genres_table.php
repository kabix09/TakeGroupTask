<?php

use App\Enums\GenreSourceEnum;
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
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('source', [GenreSourceEnum::MOVIE->value, GenreSourceEnum::TV->value]);
            $table->unsignedBigInteger('tmdb_id')->unique();
            $table->timestamps();

            $table->unique(['tmdb_id', 'source']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genres');
    }
};
