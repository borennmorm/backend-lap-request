<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('requests', function (Blueprint $table) {
            // First, drop the foreign key constraint
            $table->dropForeign(['study_time_id']);

            // Then, drop the study_time_id column
            $table->dropColumn('study_time_id');
        });
    }

    public function down()
    {
        Schema::table('requests', function (Blueprint $table) {
            // Re-add the study_time_id column and its foreign key in the rollback
            $table->foreignId('study_time_id')->constrained()->onDelete('cascade');
        });
    }


};
