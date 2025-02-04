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
}
