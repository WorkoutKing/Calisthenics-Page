<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Post;
use App\Models\Exercise;
use App\Models\Workout;

class SitemapController extends Controller
{
    public function generateSitemap()
    {
        $sitemapPath = public_path('sitemap.xml');
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Add homepage
        $xml .= '<url><loc>' . url('/') . '</loc><priority>1.0</priority></url>';

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

        $xml .= '</urlset>';

        // Save the file
        File::put($sitemapPath, $xml);

        return response()->json(['message' => 'Sitemap generated successfully!']);
    }
}
