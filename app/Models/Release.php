<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    protected $fillable = [
        'title',
        'release_date',
        'description',
        'image_url',
    ];
}
