<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_results_table.php

    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('step_id');
            $table->string('video_url')->nullable();  // To store the video URL
            $table->integer('reps')->nullable();      // For reps (if applicable)
            $table->float('time')->nullable();        // For time (if applicable)
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('step_id')->references('id')->on('steps')->onDelete('cascade');

            $table->unique(['user_id', 'step_id']);   // Ensure each user can only upload one result per step
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
