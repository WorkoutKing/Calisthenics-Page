<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Workout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'workout_type',
        'description',
        'focus',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'slug'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($workout) {
            $workout->slug = static::generateUniqueSlug($workout->title);
        });

        static::updating(function ($workout) {
            if ($workout->isDirty('title')) {
                $workout->slug = static::generateUniqueSlug($workout->title, $workout->id);
            }
        });
    }

    private static function generateUniqueSlug($title, $workoutId = null)
    {
        $slug = Str::slug($title);
        $count = Workout::where('slug', $slug)->where('id', '!=', $workoutId)->count();

        return $count > 0 ? "{$slug}-" . ($count + 1) : $slug;
    }

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'exercise_workout')
            ->withPivot('sets', 'reps', 'rest_time', 'note')
            ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
