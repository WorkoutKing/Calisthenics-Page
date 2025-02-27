<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate sitemap for the application';

    public function handle()
    {
        $sitemap = Sitemap::create();

        $sitemap->add(Url::create('/workouts'))
            ->add(Url::create('/workouts/{workout}'))
            ->add(Url::create('releases'))
            ->add(Url::create('/elements'))
            ->add(Url::create('/elements/statistics'))
            ->add(Url::create('/basics/statistics'))
            ->add(Url::create('/posts'))
            ->add(Url::create('/challenges'))
            ->add(Url::create('/profile/{userId}'))
            ->add(Url::create('/about-us'))
            ->add(Url::create('/privacy-policy'))
            ->add(Url::create('/one-rep-max-calculators'));

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap has been generated!');
    }
}
