<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\HabitatSeeder;
use Database\Seeders\AnimalSeeder;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that all main pages load successfully.
     */
    public function test_main_pages_return_successful_response(): void
    {
        // Run seeders to populate the in-memory database
        $this->seed(HabitatSeeder::class);
        $this->seed(AnimalSeeder::class);

        // 1. Home Page
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/');
        $response->assertStatus(200);

        // 2. Explore Habitats Listing Page
        $response = $this->get('/explore');
        $response->assertStatus(200);

        // 3. Explore Single Habitat Detail Page
        $response = $this->get('/explore/1');
        $response->assertStatus(200);

        // 4. Animals Listing Page
        $response = $this->get('/animals');
        $response->assertStatus(200);

        // 5. Animal Detail Page
        $response = $this->get('/animals/1');
        $response->assertStatus(200);
    }
}
