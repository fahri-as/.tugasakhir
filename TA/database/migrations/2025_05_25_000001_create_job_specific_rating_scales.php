<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSpecificRatingScales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create interview criteria table
        Schema::create('interview_criteria', function (Blueprint $table) {
            $table->string('criteria_id', 50)->primary();
            $table->string('job_id', 50);
            $table->string('name', 50);
            $table->string('code', 50)->nullable();
            $table->string('description', 255)->nullable();
            $table->decimal('weight', 10, 4)->default(0);
            $table->timestamps();

            $table->foreign('job_id')
                ->references('job_id')
                ->on('job')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        // Create interview rating scales table
        Schema::create('interview_rating_scales', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('criteria_id', 50);
            $table->integer('rating_level');
            $table->string('name', 100);
            $table->text('description');
            $table->timestamps();

            $table->foreign('criteria_id')
                ->references('criteria_id')
                ->on('interview_criteria')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unique(['criteria_id', 'rating_level']);
        });

        // Create tes_kemampuan criteria table
        Schema::create('tes_kemampuan_criteria', function (Blueprint $table) {
            $table->string('criteria_id', 50)->primary();
            $table->string('job_id', 50);
            $table->string('name', 50);
            $table->string('code', 50)->nullable();
            $table->string('description', 255)->nullable();
            $table->decimal('weight', 10, 4)->default(0);
            $table->timestamps();

            $table->foreign('job_id')
                ->references('job_id')
                ->on('job')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        // Create tes_kemampuan rating scales table
        Schema::create('tes_kemampuan_rating_scales', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('criteria_id', 50);
            $table->integer('rating_level');
            $table->string('name', 100);
            $table->text('description');
            $table->integer('min_score')->nullable();
            $table->integer('max_score')->nullable();
            $table->timestamps();

            $table->foreign('criteria_id')
                ->references('criteria_id')
                ->on('tes_kemampuan_criteria')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unique(['criteria_id', 'rating_level']);
        });

        // Add new columns to interview table
        Schema::table('interview', function (Blueprint $table) {
            $table->string('qualifikasi_criteria_id', 50)->nullable()->after('status_seleksi');
            $table->string('komunikasi_criteria_id', 50)->nullable()->after('qualifikasi_criteria_id');
            $table->string('sikap_criteria_id', 50)->nullable()->after('komunikasi_criteria_id');

            $table->foreign('qualifikasi_criteria_id')
                ->references('criteria_id')
                ->on('interview_criteria')
                ->onDelete('set null');

            $table->foreign('komunikasi_criteria_id')
                ->references('criteria_id')
                ->on('interview_criteria')
                ->onDelete('set null');

            $table->foreign('sikap_criteria_id')
                ->references('criteria_id')
                ->on('interview_criteria')
                ->onDelete('set null');
        });

        // Add new column to tes_kemampuan table
        Schema::table('tes_kemampuan', function (Blueprint $table) {
            $table->string('criteria_id', 50)->nullable()->after('status_seleksi');

            $table->foreign('criteria_id')
                ->references('criteria_id')
                ->on('tes_kemampuan_criteria')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop foreign keys from interview table
        Schema::table('interview', function (Blueprint $table) {
            $table->dropForeign(['qualifikasi_criteria_id']);
            $table->dropForeign(['komunikasi_criteria_id']);
            $table->dropForeign(['sikap_criteria_id']);
            $table->dropColumn(['qualifikasi_criteria_id', 'komunikasi_criteria_id', 'sikap_criteria_id']);
        });

        // Drop foreign key from tes_kemampuan table
        Schema::table('tes_kemampuan', function (Blueprint $table) {
            $table->dropForeign(['criteria_id']);
            $table->dropColumn('criteria_id');
        });

        // Drop tables in reverse order
        Schema::dropIfExists('tes_kemampuan_rating_scales');
        Schema::dropIfExists('tes_kemampuan_criteria');
        Schema::dropIfExists('interview_rating_scales');
        Schema::dropIfExists('interview_criteria');
    }
}
