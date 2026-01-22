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
        Schema::table('tournaments', function (Blueprint $table) {
            $table->longText('custom_text')->nullable()->after('description');
            $table->integer('time_limit')->nullable()->comment('Time limit in seconds')->after('max_participants');
        });

        Schema::table('typing_matches', function (Blueprint $table) {
            $table->integer('time_limit')->nullable()->comment('Time limit in seconds')->after('text_content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropColumn(['custom_text', 'time_limit']);
        });

        Schema::table('typing_matches', function (Blueprint $table) {
            $table->dropColumn('time_limit');
        });
    }
};
