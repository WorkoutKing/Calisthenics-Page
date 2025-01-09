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
        Schema::table('notifications', function (Blueprint $table) {
            // Add notifiable_type and notifiable_id columns
            $table->string('notifiable_type');
            $table->unsignedBigInteger('notifiable_id');
        });
    }

    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Remove the columns if the migration is rolled back
            $table->dropColumn(['notifiable_type', 'notifiable_id']);
        });
    }

};
