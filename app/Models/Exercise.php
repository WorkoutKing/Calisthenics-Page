<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    // Define the one-to-many relationship with MuscleGroup (for primary muscle group)
    public function primaryMuscleGroup()
    {
        return $this->belongsTo(MuscleGroup::class, 'primary_muscle_group_id');
    }

    // Define the many-to-many relationship for secondary muscle groups
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

    // Define the many-to-many relationship with workouts through the pivot table
    public function workouts()
    {
        return $this->belongsToMany(Workout::class, 'exercise_workout')
            ->withPivot('sets', 'reps', 'rest_time')
            ->withTimestamps();
    }
}
