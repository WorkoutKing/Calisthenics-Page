<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Element;
use App\Models\Step;

class ElementSeeder extends Seeder
{
    public function run()
    {
        // Define all elements and their steps
        $elementsWithSteps = [
            'Wall Handstand' => [
                ['name' => 'Wall Handstand Hold', 'criteria' => 'Hold the wall handstand position for 30 seconds.', 'points' => 14],
            ],
            'Handstand' => [
                ['name' => 'Freestanding Handstand', 'criteria' => 'Hold a freestanding handstand for 30 seconds.', 'points' => 15],
            ],
            'Wall Handstand PU' => [
                ['name' => 'Wall Handstand Push-Up', 'criteria' => 'Perform a wall handstand push-up for 10 repetitions.', 'points' => 19],
            ],
            'Handstand Push Up' => [
                ['name' => 'Freestanding Handstand Push-Up', 'criteria' => 'Perform a freestanding handstand push-up for 6 repetitions.', 'points' => 21],
            ],
            'One Arm Handstand' => [
                ['name' => 'One Arm Handstand Hold', 'criteria' => 'Hold a one-arm handstand position for 15 seconds.', 'points' => 30],
            ],
            'German Hang' => [
                ['name' => 'German Hang Hold', 'criteria' => 'Hold the German hang position for 60 second.', 'points' => 1],
            ],
            'Back Lever Progression' => [
                ['name' => 'Tuck Back Lever', 'criteria' => 'Hold the tuck back lever position for 30 seconds.', 'points' => 5],
                ['name' => 'Advance Back Lever', 'criteria' => 'Hold the advanced back lever position for 20 seconds.', 'points' => 6],
                ['name' => 'Straddle Back Lever', 'criteria' => 'Hold the straddle back lever position for 10 seconds.', 'points' => 22],
                ['name' => 'Full Back Lever', 'criteria' => 'Hold the full back lever position for 3 seconds.', 'points' => 23],
                ['name' => 'Full Back Lever Pull-Ups', 'criteria' => 'Perform pull-ups in the full back lever position for 10 repetitions.', 'points' => 29],
            ],
            'Rows/Australian Pull Ups' => [
                ['name' => 'Australian Pull-Ups', 'criteria' => 'Perform Australian pull-ups for 30 repetitions.', 'points' => 3],
            ],
            'Front Lever Progression' => [
                ['name' => 'Tuck Front Lever', 'criteria' => 'Hold the tuck front lever position for 30 seconds.', 'points' => 9],
                ['name' => 'Advance Front Lever', 'criteria' => 'Hold the advanced front lever position for 20 seconds.', 'points' => 19],
                ['name' => 'Straddle Front Lever', 'criteria' => 'Hold the straddle front lever position for 10 seconds.', 'points' => 26],
                ['name' => 'Full Front Lever', 'criteria' => 'Hold the full front lever position for 3 seconds.', 'points' => 28],
                ['name' => 'Straddle Front Lever Pull-Ups', 'criteria' => 'Perform pull-ups in the straddle front lever position for 9 repetitions.', 'points' => 30],
                ['name' => 'Full Front Lever Pull-Ups', 'criteria' => 'Perform pull-ups in the full front lever position for 3 repetitions.', 'points' => 31],
                ['name' => 'Hang Pull FL to Inverted', 'criteria' => 'Perform hanging pulls from front lever to inverted for 3 repetitions.', 'points' => 35],
                ['name' => 'Circle Front Lever', 'criteria' => 'Perform circular movements in the front lever position for 3 repetitions.', 'points' => 36],
            ],
            'Planche Progression' => [
                ['name' => 'Lean Planche', 'criteria' => 'Hold the lean planche position for 60 seconds.', 'points' => 3],
                ['name' => 'Frog Stand', 'criteria' => 'Hold the frog stand position for 60 seconds.', 'points' => 4],
                ['name' => 'Tuck Planche', 'criteria' => 'Hold the tuck planche position for 30 seconds.', 'points' => 19],
                ['name' => 'Advance Planche', 'criteria' => 'Hold the advanced planche position for 20 seconds.', 'points' => 24],
                ['name' => 'Straddle Planche', 'criteria' => 'Hold the straddle planche position for 10 seconds.', 'points' => 25],
                ['name' => 'Full Planche', 'criteria' => 'Hold the full planche position for 3 seconds.', 'points' => 31],
            ],
            'Muscle Ups' => [
                ['name' => 'Muscle Up', 'criteria' => 'Perform a muscle-up for 20 repetitions.', 'points' => 26],
                ['name' => 'Wide Muscle Up', 'criteria' => 'Perform a wide muscle-up for 15 repetitions.', 'points' => 27],
                ['name' => 'L-Sit Muscle Up', 'criteria' => 'Perform an L-sit muscle-up for 10 repetitions.', 'points' => 29],
            ],
            'Squats Progression' => [
                ['name' => 'Full Squat', 'criteria' => 'Perform a full squat for 30 repetitions.', 'points' => 3],
                ['name' => 'Assisted Pistol Squat', 'criteria' => 'Perform an assisted pistol squat for 15 repetitions.', 'points' => 14],
                ['name' => 'Shrimp Squat', 'criteria' => 'Perform a shrimp squat for 10 repetitions.', 'points' => 19],
                ['name' => 'Pistol Squat', 'criteria' => 'Perform a pistol squat for 6 repetitions.', 'points' => 23],
            ],
            'Dragon Flag Progression' => [
                ['name' => 'Adv Tuck Dragon Flag', 'criteria' => 'Perform an advanced tuck dragon flag for 30 repetitions.', 'points' => 16],
                ['name' => 'Straddle Dragon Flag', 'criteria' => 'Perform a straddle dragon flag for 20 repetitions.', 'points' => 19],
                ['name' => 'Dragon Flag', 'criteria' => 'Perform a dragon flag for 10 repetitions.', 'points' => 20],
                ['name' => 'Ab Wheel', 'criteria' => 'Perform an ab wheel rollout for 8 repetitions.', 'points' => 24],
                ['name' => 'Ankle Weight Dragon Flag', 'criteria' => 'Perform an ankle-weighted dragon flag for 6 repetitions.', 'points' => 30],
                ['name' => 'One Arm Dragon Flag', 'criteria' => 'Perform a one-arm dragon flag for 3 repetitions.', 'points' => 31],
                ['name' => 'One Arm Ab Wheel', 'criteria' => 'Perform a one-arm ab wheel rollout for 3 repetitions.', 'points' => 34],
            ],
        ];

        // Creating elements and steps
        foreach ($elementsWithSteps as $elementName => $steps) {
            $element = Element::create([
                'name' => $elementName,
                'description' => $elementName . ' progression steps.',
            ]);

            foreach ($steps as $step) {
                Step::create([
                    'element_id' => $element->id,
                    'name' => $step['name'],
                    'criteria' => $step['criteria'],
                    'points' => $step['points'],
                ]);
            }
        }
    }
}
