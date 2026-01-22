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
        Schema::table('typing_matches', function (Blueprint $table) {
            $table->boolean('player1_ready')->default(false);
            $table->boolean('player2_ready')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('typing_matches', function (Blueprint $table) {
            $table->dropColumn(['player1_ready', 'player2_ready']);
        });
    }
};
