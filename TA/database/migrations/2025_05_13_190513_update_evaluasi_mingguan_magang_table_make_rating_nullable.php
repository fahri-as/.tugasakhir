<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Make the rating_id column nullable in the evaluasi_mingguan_magang table
     */
    public function up(): void
    {
        Schema::table('evaluasi_mingguan_magang', function (Blueprint $table) {
            $table->string('rating_id', 50)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     * Make the rating_id column required again
     */
    public function down(): void
    {
        Schema::table('evaluasi_mingguan_magang', function (Blueprint $table) {
            $table->string('rating_id', 50)->nullable(false)->change();
        });
    }
};
