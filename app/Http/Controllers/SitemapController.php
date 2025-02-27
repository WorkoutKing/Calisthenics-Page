<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Post;
use App\Models\Exercise;
use App\Models\Workout;
use Carbon\Carbon;

class SitemapController extends Controller
{
    public function generateSitemap()
    {
        $sitemapPath = public_path('sitemap.xml');
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Add sitemap generation date
        $xml .= '<!-- Generated on ' . Carbon::now()->toDateTimeString() . ' -->';

        // Add homepage
        $xml .= '<url><loc>' . url('/') . '</loc><priority>1.0</priority></url>';

        // Add static pages
        $staticPages = [
            route('pages.about-us'),
            route('pages.privacy-policy'),
            route('elements.index'),
            route('elements.statistics'),
            route('basics.statistics'),
            route('posts.index'),
            route('challenges.index'),
            route('exercises.index'),
            route('workouts.index'),
            route('releases.index'),
        ];

        foreach ($staticPages as $page) {
            $xml .= '<url>';
            $xml .= '<loc>' . $page . '</loc>';
            $xml .= '<priority>0.6</priority>';
            $xml .= '</url>';
        }

        // Add posts
        $posts = Post::all();
        foreach ($posts as $post) {
            $xml .= '<url>';
            $xml .= '<loc>' . route('posts.show', ['post' => $post->slug]) . '</loc>';
            $xml .= '<lastmod>' . $post->updated_at->toAtomString() . '</lastmod>';
            $xml .= '<priority>0.8</priority>';
            $xml .= '</url>';
        }

        // Add exercises
        $exercises = Exercise::all();
        foreach ($exercises as $exercise) {
            $xml .= '<url>';
            $xml .= '<loc>' . route('exercises.show', ['exercise' => $exercise->slug]) . '</loc>';
            $xml .= '<lastmod>' . $exercise->updated_at->toAtomString() . '</lastmod>';
            $xml .= '<priority>0.7</priority>';
            $xml .= '</url>';
        }

        // Add workouts
        $workouts = Workout::all();
        foreach ($workouts as $workout) {
            $xml .= '<url>';
            $xml .= '<loc>' . route('workouts.show', ['workout' => $workout->slug]) . '</loc>';
            $xml .= '<lastmod>' . $workout->updated_at->toAtomString() . '</lastmod>';
            $xml .= '<priority>0.7</priority>';
            $xml .= '</url>';
        }

        // Add challenges (assuming ID-based URLs)
        $challenges = \App\Models\Challenge::all();
        foreach ($challenges as $challenge) {
            $xml .= '<url>';
            $xml .= '<loc>' . route('challenges.show', ['id' => $challenge->id]) . '</loc>';
            $xml .= '<lastmod>' . $challenge->updated_at->toAtomString() . '</lastmod>';
            $xml .= '<priority>0.6</priority>';
            $xml .= '</url>';
        }

        // Add user profiles (assuming user ID is available)
        $users = \App\Models\User::all();
        foreach ($users as $user) {
            $xml .= '<url>';
            $xml .= '<loc>' . route('profile.other', ['userId' => $user->id]) . '</loc>';
            $xml .= '<priority>0.5</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        // Save the file
        File::put($sitemapPath, $xml);

        return response()->json(['message' => 'Sitemap generated successfully!', 'generated_at' => Carbon::now()]);
    }
}
