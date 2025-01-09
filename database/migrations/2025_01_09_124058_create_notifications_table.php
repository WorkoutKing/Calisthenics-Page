<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();  // Using UUID as the primary key
            $table->morphs('notifiable');  // Creates notifiable_type and notifiable_id columns
            $table->string('type')->nullable();  // Notification type
            $table->text('data');  // Notification data (message, etc.)
            $table->timestamp('read_at')->nullable();  // Restore this column
            $table->boolean('read')->default(0);  // Boolean to track if notification is read (default: 0)
            $table->timestamps();  // Created and updated timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
