<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('steps', function (Blueprint $table) {
            $table->foreignId('exercise_id')->nullable()->constrained('exercises')->onDelete('cascade');
        });

        Schema::table('elements', function (Blueprint $table) {
            $table->foreignId('exercise_id')->nullable()->constrained('exercises')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('steps', function (Blueprint $table) {
            $table->dropForeign(['exercise_id']);
            $table->dropColumn('exercise_id');
        });

        Schema::table('elements', function (Blueprint $table) {
            $table->dropForeign(['exercise_id']);
            $table->dropColumn('exercise_id');
        });
    }
};
