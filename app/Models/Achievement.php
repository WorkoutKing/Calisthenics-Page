<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'element_id',
        'completed_at',
    ];

    // Explicitly cast completed_at to a Carbon instance
    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function element()
    {
        return $this->belongsTo(Element::class);
    }
}
