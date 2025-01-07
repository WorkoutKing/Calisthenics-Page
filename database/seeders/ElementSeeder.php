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
        // Creating elements
        $tuckFront = Element::create([
            'name' => 'Tuck Front Lever',
            'description' => 'The tuck front lever is a bodyweight exercise that focuses on core strength and control.'
        ]);

        $frontLeverProgression = Element::create([
            'name' => 'Front Lever Progression',
            'description' => 'The front lever progression includes various steps to build strength for a full front lever.'
        ]);

        // Creating steps for Tuck Front Lever
        Step::create([
            'element_id' => $tuckFront->id,
            'name' => 'Tuck Front Lever Hold',
            'criteria' => 'Hold the tuck front lever position for 10-15 seconds.',
            'points' => 50
        ]);

        Step::create([
            'element_id' => $tuckFront->id,
            'name' => 'Advanced Tuck Front Lever Hold',
            'criteria' => 'Hold the advanced tuck front lever position for 15-30 seconds.',
            'points' => 100
        ]);

        // Creating steps for Front Lever Progression
        Step::create([
            'element_id' => $frontLeverProgression->id,
            'name' => 'Front Lever Raise',
            'criteria' => 'From a hanging position, raise your body to a front lever hold.',
            'points' => 70
        ]);

        Step::create([
            'element_id' => $frontLeverProgression->id,
            'name' => 'Advanced Front Lever Raise',
            'criteria' => 'Hold the front lever raise position for 15-30 seconds.',
            'points' => 120
        ]);
    }
}
