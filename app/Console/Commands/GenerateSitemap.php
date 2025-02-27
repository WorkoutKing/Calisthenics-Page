<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Post;
use App\Models\Exercise;
use App\Models\Workout;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap for the site';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $sitemap = Sitemap::create();

        $sitemap->add(Url::create(url('/'))->setPriority(1.0));

        Post::all()->each(function ($post) use ($sitemap) {
            $sitemap->add(Url::create(route('posts.show', ['post' => $post->slug]))->setLastModificationDate($post->updated_at));
        });

        Exercise::all()->each(function ($exercise) use ($sitemap) {
            $sitemap->add(Url::create(route('exercises.show', ['exercise' => $exercise->slug]))->setLastModificationDate($exercise->updated_at));
        });

        Workout::all()->each(function ($workout) use ($sitemap) {
            $sitemap->add(Url::create(route('workouts.show', ['workout' => $workout->slug]))->setLastModificationDate($workout->updated_at));
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap has been generated!');
    }
}
