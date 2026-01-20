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
        Schema::create('typing_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player1_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('player2_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('winner_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->text('text_content'); // The text to type
            $table->string('status')->default('pending'); // pending, ongoing, completed
            $table->integer('player1_progress')->default(0); // 0-100 percentage
            $table->integer('player2_progress')->default(0);
            $table->decimal('player1_wpm', 8, 2)->nullable();
            $table->decimal('player2_wpm', 8, 2)->nullable();
            $table->decimal('player1_accuracy', 5, 2)->nullable();
            $table->decimal('player2_accuracy', 5, 2)->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('points')->default(0)->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('typing_matches');
        
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('points');
        });
    }
};
