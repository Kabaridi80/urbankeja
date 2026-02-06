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
        Schema::table('properties', function (Blueprint $table) {
        $table->boolean('is_quiet')->default(false);        // For rich/peaceful searchers
$table->boolean('near_transport')->default(false);  // For matatu/commuter users
$table->boolean('near_shopping')->default(false);   // For convenience seekers
$table->boolean('has_view')->default(false);        // For luxury/elegant feel    //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            //
        });
    }
};
