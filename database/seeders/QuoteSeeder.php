<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quote;

class QuoteSeeder extends Seeder
{
    public function run()
    {
        $quotes = [
            // Motivational Quotes
            [
                'quote' => 'The only way to do great work is to love what you do.',
                'author' => 'Steve Jobs'
            ],
            [
                'quote' => 'Success is not final, failure is not fatal: It is the courage to continue that counts.',
                'author' => 'Winston Churchill'
            ],
            [
                'quote' => 'It does not matter how slowly you go as long as you do not stop.',
                'author' => 'Confucius'
            ],
            [
                'quote' => 'Believe you can and you’re halfway there.',
                'author' => 'Theodore Roosevelt'
            ],
            [
                'quote' => 'The future belongs to those who believe in the beauty of their dreams.',
                'author' => 'Eleanor Roosevelt'
            ],
            [
                'quote' => 'Know thyself.',
                'author' => 'Socrates'
            ],
            [
                'quote' => 'The unexamined life is not worth living.',
                'author' => 'Socrates'
            ],
            [
                'quote' => 'Happiness depends upon ourselves.',
                'author' => 'Aristotle'
            ],
            [
                'quote' => 'Man is the measure of all things.',
                'author' => 'Protagoras'
            ],
            [
                'quote' => 'The mind is furnished with ideas by experience alone.',
                'author' => 'John Locke'
            ],
            [
                'quote' => 'In this world, is the destiny of mankind controlled by some transcendental entity or law? Is it like the hand of God hovering above? At least it is true that man has no control, even over his own will.',
                'author' => 'Johann Liebert (Monster)'
            ],
            [
                'quote' => 'This world is imperfect, but there is beauty in that imperfection.',
                'author' => 'Aizen Sousuke (Bleach)'
            ],
            [
                'quote' => 'The moment you find the courage to give up on everything, that’s when you truly start living.',
                'author' => 'Pain (Naruto)'
            ],
            [
                'quote' => 'The best way to predict the future is to create it.',
                'author' => 'Peter Drucker'
            ],
            [
                'quote' => 'Don’t watch the clock; do what it does. Keep going.',
                'author' => 'Sam Levenson'
            ],
            [
                'quote' => 'The only limit to our realization of tomorrow is our doubts of today.',
                'author' => 'Franklin D. Roosevelt'
            ],
            [
                'quote' => 'Act as if what you do makes a difference. It does.',
                'author' => 'William James'
            ],
            [
                'quote' => 'You are never too old to set another goal or to dream a new dream.',
                'author' => 'C.S. Lewis'
            ],
            [
                'quote' => 'In the end, we will remember not the words of our enemies, but the silence of our friends.',
                'author' => 'Martin Luther King Jr.'
            ],
            [
                'quote' => 'The only thing we have to fear is fear itself.',
                'author' => 'Franklin D. Roosevelt'
            ],
            [
                'quote' => 'I have not failed. I’ve just found 10,000 ways that won’t work.',
                'author' => 'Thomas Edison'
            ],
            [
                'quote' => 'The best and most beautiful things in the world cannot be seen or even touched — they must be felt with the heart.',
                'author' => 'Helen Keller'
            ],
            [
                'quote' => 'The journey of a thousand miles begins with one step.',
                'author' => 'Lao Tzu'
            ],
            [
                'quote' => 'In this world, is the destiny of mankind controlled by some transcendental entity or law? Is it like the hand of God hovering above? At least it is true that man has no control, even over his own will.',
                'author' => 'Guts (Berserk)'
            ],
            [
                'quote' => 'If you’re always worried about crushing the ants beneath you, you won’t be able to walk.',
                'author' => 'Guts (Berserk)'
            ],
            [
                'quote' => 'You’re going to be all right. You just stumbled over a stone in the road. It means nothing. Your goal lies far beyond this. Doesn’t it? I’m sure you’ll overcome this. You’ll walk again… soon.',
                'author' => 'Guts (Berserk)'
            ],
            [
                'quote' => 'Struggle, endure, contend. For that alone is the sword of one who defies death.',
                'author' => 'Guts (Berserk)'
            ],

            [
                'quote' => 'I don’t like sand. It’s coarse and rough and irritating, and it gets everywhere.',
                'author' => 'Anakin Skywalker (Star Wars)'
            ],
            [
                'quote' => 'I am the Chosen One. I will bring balance to the Force.',
                'author' => 'Anakin Skywalker (Star Wars)'
            ],
        ];

        foreach ($quotes as $quote) {
            Quote::create($quote);        }
    }
}