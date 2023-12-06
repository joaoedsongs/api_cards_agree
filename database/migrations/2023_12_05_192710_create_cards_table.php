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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('hp');
            $table->boolean('first_edition');
            $table->unsignedBigInteger('expansion_id');
            $table->unsignedBigInteger('rarity_id');
            $table->decimal('price', 8, 2);
            $table->string('img')->nullable();
            $table->timestamps();

            $table->foreign('expansion_id')->references('id')->on('expansions');
            $table->foreign('rarity_id')->references('id')->on('rarities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
