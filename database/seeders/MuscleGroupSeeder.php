<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MuscleGroup;

class MuscleGroupSeeder extends Seeder
{
    public function run()
    {
        // A collection of various anatomical regions and segments related to the human musculature system
        $muscleGroups = [
            'Pectoralis Major (Chest)',
            'Dorsal Musculature (Back)',
            'Deltoid Complex (Shoulders)',
            'Brachial Region (Biceps)',
            'Triceps Brachii (Triceps)',
            'Abdominal Musculature (Abs)',
            'Lower Extremity Muscles (Legs)',
            'Antebrachial Region (Forearms)',
            'Trapezius (Traps)',
            'Gastrocnemius & Soleus (Calves)',
            'Gluteal Region (Glutes)',
            'Iliopsoas Complex (Hip Flexors)',
            'Ischiocrural Musculature (Hamstrings)',
            'Quadriceps Femoris (Quads)',
            'Lumbar Musculature (Lower Back)',
            'Thoracic & Upper Dorsal Musculature (Upper Back)',
            'Latissimus Dorsi (Lats)',
            'Oblique Muscles (Obliques)',
            'Adductor Group (Adductors)',
            'Abductor Group (Abductors)',
            'Core Stabilizers (Core)',
            'Serratus Anterior (Serratus)',
            'Rotator Cuff Muscles',
            'Rhomboid Muscles',
            'Pectoralis Minor (Minor Chest)',
            'Anterior Tibialis (Tibialis Anterior)',
            'Spinal Erectors (Erector Spinae)',
            'Levator Scapulae Muscles',
            'Intercostal Musculature (Intercostals)',
            'Teres Muscles (Major & Minor)',
            'Supraspinatus (Supraspinatus)',
            'Infraspinatus Muscles',
            'Brachialis (Brachialis)',
            'Anconeus Muscle (Anconeus)',
            'Gracilis Muscles',
            'Gastrocnemius Muscles (Gastrocs)',
            'Soleus Muscles (Soleus)',
            'Popliteal Region (Popliteus)',
            'Flexor Muscles of the Wrist',
            'Extensor Muscles of the Wrist',
            'Pronation Mechanism (Pronators)',
            'Supination Mechanism (Supinators)',
            'Sartorius Muscle',
            'Tensor Fasciae Latae (TFL)',
            'Psoas Major (Psoas)',
            'Iliacus Muscles',
            'Deltoid Complex (Deltoids)',
            'Pectoralis Minor Muscles',
            'Latissimus Dorsi Muscles (Lats)',
            'Gluteus Medius & Minimus',
            'Brachioradialis Muscle (Forearm)',
            'Plantar Flexor Musculature (Plantar Flexors)',
            'Flexor Digitorum Superficialis (Finger Flexors)',
            'Extensor Digitorum Longus',
            'Adductor Magnus Muscles',
            'Adductor Longus Muscles',
            'Adductor Brevis Muscles',
            'Extensor Pollicis Longus',
            'Flexor Pollicis Longus',
            'Flexor Carpi Ulnaris',
            'Extensor Carpi Ulnaris',
            'Flexor Carpi Radialis',
            'Extensor Carpi Radialis',
            'Flexor Digitorum Superficialis Muscles',
            'Flexor Digitorum Profundus',
            'Extensor Digitorum Longus Muscles',
            'Extensor Hallucis Longus',
            'Flexor Hallucis Longus',
            'Extensor Indicis',
            'Extensor Pollicis Brevis',
            'Abductor Pollicis Longus',
            'Flexor Pollicis Longus Muscles'
        ];

        foreach ($muscleGroups as $muscleGroup) {
            MuscleGroup::create([
                'name' => $muscleGroup
            ]);
        }

        $this->command->info('Anatomical regions and their respective muscle groups seeded successfully!');
    }
}
