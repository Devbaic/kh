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
        Schema::create('bests', function (Blueprint $table) {
            $table->id();
            $table->string('month')->nullable();
            $table->string('by')->nullable();
            $table->string('cover')->nullable();
            $table->text('content')->nullable();
            $table->string('filebook')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bests');
    }
};
