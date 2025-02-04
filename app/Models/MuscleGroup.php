<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MuscleGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Define the inverse of the relationship for exercises
    public function exercises()
    {
        return $this->hasMany(Exercise::class, 'primary_muscle_group_id');
    }

    // Define the many-to-many relationship for secondary muscle groups
    public function secondaryExercises()
    {
        return $this->belongsToMany(Exercise::class, 'exercise_muscle_group');
    }
}
