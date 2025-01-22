<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'step_id', 'video_url', 'reps_time', 'approved'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function step()
    {
        return $this->belongsTo(Step::class);
    }

    public function approve()
    {
        $this->update(['approved' => true]);
    }
    public function meta()
    {
        return $this->morphOne(Meta::class, 'metaable');
    }
}

