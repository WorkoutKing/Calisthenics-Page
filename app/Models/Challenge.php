<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
    ];

    public function participants()
    {
        return $this->belongsToMany(User::class, 'user_challenges', 'challenge_id', 'user_id')
            ->withTimestamps();
    }
    public function challengeResults()
    {
        return $this->hasMany(ChallengeResult::class);
    }
    public function meta()
    {
        return $this->morphOne(Meta::class, 'metaable');
    }
}

