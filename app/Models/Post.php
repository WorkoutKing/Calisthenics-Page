<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'main_picture',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'slug'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = static::generateUniqueSlug($post->title);
        });

        static::updating(function ($post) {
            if ($post->isDirty('title')) {
                $post->slug = static::generateUniqueSlug($post->title, $post->id);
            }
        });
    }

    private static function generateUniqueSlug($title, $postId = null)
    {
        $slug = Str::slug($title);
        $count = Post::where('slug', $slug)->where('id', '!=', $postId)->count();

        return $count > 0 ? "{$slug}-" . ($count + 1) : $slug;
    }

    public function meta()
    {
        return $this->morphOne(Meta::class, 'metaable');
    }
}
