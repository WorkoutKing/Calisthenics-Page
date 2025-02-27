<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'main_picture',
        'primary_muscle_group_id',
        'media_first_frame',
        'media_url',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'slug'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($exercise) {
            $exercise->slug = static::generateUniqueSlug($exercise->title);
        });

        static::updating(function ($exercise) {
            if ($exercise->isDirty('title')) {
                $exercise->slug = static::generateUniqueSlug($exercise->title, $exercise->id);
            }
        });
    }

    private static function generateUniqueSlug($title, $exerciseId = null)
    {
        $slug = Str::slug($title);
        $count = Exercise::where('slug', $slug)->where('id', '!=', $exerciseId)->count();

        return $count > 0 ? "{$slug}-" . ($count + 1) : $slug;
    }

    public function primaryMuscleGroup()
    {
        return $this->belongsTo(MuscleGroup::class, 'primary_muscle_group_id');
    }

    public function secondaryMuscleGroups()
    {
        return $this->belongsToMany(MuscleGroup::class, 'exercise_muscle_group');
    }
    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function elements()
    {
        return $this->hasMany(Element::class);
    }

    public function workouts()
    {
        return $this->belongsToMany(Workout::class, 'exercise_workout')
            ->withPivot('sets', 'reps', 'rest_time')
            ->withTimestamps();
    }
}
