<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Exercise;
use App\Models\Workout;
use App\Models\Post;
use Illuminate\Support\Str;

return new class extends Migration {
    public function up()
    {
        Schema::table('exercises', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
        });

        Schema::table('workouts', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
        });

        foreach (Exercise::all() as $exercise) {
            $exercise->slug = Str::slug($exercise->title) ?: 'exercise-' . $exercise->id;
            $exercise->save();
        }

        foreach (Workout::all() as $workout) {
            $workout->slug = Str::slug($workout->title) ?: 'workout-' . $workout->id;
            $workout->save();
        }

        foreach (Post::all() as $post) {
            $post->slug = Str::slug($post->title) ?: 'post-' . $post->id;
            $post->save();
        }

        Schema::table('exercises', function (Blueprint $table) {
            $table->unique('slug');
        });

        Schema::table('workouts', function (Blueprint $table) {
            $table->unique('slug');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    public function down()
    {
        Schema::table('exercises', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });

        Schema::table('workouts', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
