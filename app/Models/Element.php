<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $fillable = ['name', 'description'];

    //
    public function steps()
    {
        return $this->hasMany(Step::class);
    }
    public function meta()
    {
        return $this->morphOne(Meta::class, 'metaable');
    }
}

