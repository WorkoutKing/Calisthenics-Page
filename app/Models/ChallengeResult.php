<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChallengeResult extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'challenge_id', 'result', 'approved'];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    public function approve()
    {
        $this->update(['approved' => true]);
    }
}

