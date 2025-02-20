<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $fillable = ['element_id', 'name', 'criteria', 'points', 'exercise_id'];

    //
    public function element()
    {
        return $this->belongsTo(Element::class);
    }
    public function results()
    {
        return $this->hasMany(Result::class);
    }
    public function meta()
    {
        return $this->morphOne(Meta::class, 'metaable');
    }
    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

}
