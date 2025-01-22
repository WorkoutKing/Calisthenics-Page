<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'main_picture'];

    public function meta()
    {
        return $this->morphOne(Meta::class, 'metaable');
    }
}
