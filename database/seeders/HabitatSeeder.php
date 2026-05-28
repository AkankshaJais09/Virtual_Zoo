<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Habitat;

class HabitatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $habitats = [
            [
                'name' => 'Amazon Rainforest',
                'description' => 'A dense, tropical wonderland overflowing with biodiversity, towering trees, and the winding Amazon River, home to unique and colorful wildlife.',
                'climate' => 'forest',
                'region' => 'Amazon Basin',
                'image_path' => '/images/Habitats/Amazon Rainforest.jpg',
                'color_theme' => 'green',
            ],
            [
                'name' => 'Arctic Tundra',
                'description' => 'A freezing, wind-swept northern expanse where resilient animals adapt to extreme temperatures and seasonal landscapes of ice and snow.',
                'climate' => 'cold',
                'region' => 'Arctic Circle',
                'image_path' => '/images/Habitats/Arctic Tundra.jpg',
                'color_theme' => 'blue',
            ],
            [
                'name' => 'Asian Jungle',
                'description' => 'A lush, bamboo-rich environment filled with dense canopies, tropical monsoons, and legendary predators creeping through the shadows.',
                'climate' => 'forest',
                'region' => 'Southeast Asia',
                'image_path' => '/images/Habitats/Asian Jungle.jpg',
                'color_theme' => 'green',
            ],
            [
                'name' => 'Sahara Desert',
                'description' => 'An endless sea of golden dunes and blistering heat, home to specialized desert survivalists that thrive under the intense sun.',
                'climate' => 'hot',
                'region' => 'North Africa',
                'image_path' => '/images/Habitats/Sahara Desert.jpg',
                'color_theme' => 'amber',
            ],
            [
                'name' => 'Tropical Aviary',
                'description' => 'A spectacular domed sanctuary showcasing free-flying, exotic birds with stunning feathers and beautiful songs from the world\'s rainforests.',
                'climate' => 'forest',
                'region' => 'Global Canopy',
                'image_path' => '/images/Habitats/Tropical Aviary.jpg',
                'color_theme' => 'amber',
            ],
            [
                'name' => 'Coral Reef',
                'description' => 'A vibrant, sunlit underwater metropolis teeming with colorful coral formations, intelligent marine life, and active reef dwellers.',
                'climate' => 'aquatic',
                'region' => 'Indo-Pacific',
                'image_path' => '/images/Habitats/coral reef.jpg',
                'color_theme' => 'cyan',
            ],
        ];

        foreach ($habitats as $habitat) {
            Habitat::updateOrCreate(['name' => $habitat['name']], $habitat);
        }
    }
}
