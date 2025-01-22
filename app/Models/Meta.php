<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $fillable = ['meta_title', 'meta_description', 'meta_keywords'];

    public function metaable()
    {
        return $this->morphTo();
    }
}
