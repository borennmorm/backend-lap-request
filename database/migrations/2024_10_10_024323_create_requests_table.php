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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lab_id');
            $table->unsignedBigInteger('study_time_id');
            $table->unsignedBigInteger('user_id');

            $table->date('request_date');
            $table->string('major', 100)->nullable();
            $table->string('subject', 100)->nullable();
            $table->integer('generation')->nullable();
            $table->string('software_need', 255)->nullable();
            $table->integer('number_of_student')->nullable();
            $table->text('additional')->nullable();
            $table->timestamps();

            // Define the foreign keys
            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');
            $table->foreign('study_time_id')->references('id')->on('study_times')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
