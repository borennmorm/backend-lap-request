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
        Schema::create('study_time_approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_id');
            $table->unsignedBigInteger('study_time_id');
            $table->boolean('is_approved')->nullable();  
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('request_id')->references('id')->on('requests')->onDelete('cascade');
            $table->foreign('study_time_id')->references('id')->on('study_times')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_time_approval');
    }
};
