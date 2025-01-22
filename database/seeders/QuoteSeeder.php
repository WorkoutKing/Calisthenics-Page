<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quote;

class QuoteSeeder extends Seeder
{
    public function run()
    {
        Quote::create([
            'quote' => 'The only way to do great work is to love what you do.',
            'author' => 'Steve Jobs'
        ]);

        Quote::create([
            'quote' => 'Success is not final, failure is not fatal: It is the courage to continue that counts.',
            'author' => 'Winston Churchill'
        ]);

        Quote::create([
            'quote' => 'It does not matter how slowly you go as long as you do not stop.',
            'author' => 'Confucius'
        ]);
    }
}
