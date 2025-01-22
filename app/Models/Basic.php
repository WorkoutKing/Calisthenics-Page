<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basic extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'exercise', 'video_url', 'reps', 'approved'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function meta()
    {
        return $this->morphOne(Meta::class, 'metaable');
    }
}
