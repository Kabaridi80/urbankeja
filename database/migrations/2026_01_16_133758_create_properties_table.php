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
    Schema::create('properties', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // The Agent
        $table->string('title');
        $table->text('description');
        $table->decimal('price', 15, 2);
        $table->string('type'); // Apartment, Bedsitter, Land
        $table->string('city');
        $table->string('estate');
        $table->string('landmark'); // "Near the stage", "Opposite Mall"
        $table->string('image')->nullable();
        $table->timestamps();
    });
}
};
