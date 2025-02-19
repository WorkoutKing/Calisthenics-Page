<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exercise;
use App\Models\User;

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
    ];

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
