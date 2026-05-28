<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Akanksha Jaiswal',
            'email' => 'admin@wildverse.com',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);

        $this->call(HabitatSeeder::class);
        $this->call(AnimalSeeder::class);

        // Seed some random favourites & activities for realistic admin panel data
        $users = \App\Models\User::all();
        $animals = \App\Models\Animal::all();
        foreach ($users as $user) {
            $favAnimals = $animals->random(rand(2, 5));
            foreach ($favAnimals as $animal) {
                \App\Models\Favourite::create([
                    'user_id' => $user->id,
                    'animal_id' => $animal->id,
                ]);

                \App\Models\Activity::create([
                    'user_id' => $user->id,
                    'type' => 'favourite_add',
                    'description' => $user->name . ' added ' . $animal->name . ' to favourites.',
                    'animal_id' => $animal->id,
                    'created_at' => now()->subHours(rand(1, 48)),
                ]);
            }

            // Seed some random login activities
            \App\Models\Activity::create([
                'user_id' => $user->id,
                'type' => 'login',
                'description' => $user->name . ' logged into the system.',
                'created_at' => now()->subHours(rand(1, 48)),
            ]);

            // Seed some random view activities
            $viewedAnimals = $animals->random(rand(2, 4));
            foreach ($viewedAnimals as $animal) {
                \App\Models\Activity::create([
                    'user_id' => $user->id,
                    'type' => 'view_animal',
                    'description' => $user->name . ' viewed the details for ' . $animal->name . '.',
                    'animal_id' => $animal->id,
                    'created_at' => now()->subHours(rand(1, 48)),
                ]);
            }
        }
    }
}
