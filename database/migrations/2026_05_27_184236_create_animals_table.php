<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('scientific_name');
            $table->foreignId('habitat_id')->constrained()->onDelete('cascade');
            $table->string('type'); // mammal, bird, reptile, fish, amphibian
            $table->string('diet'); // carnivore, herbivore, omnivore
            $table->string('conservation_status'); // Least Concern, Vulnerable, Endangered, Critically Endangered
            $table->double('weight_kg');
            $table->integer('lifespan_years');
            $table->double('speed_kmh');
            $table->text('fun_fact');
            $table->text('description');
            $table->string('image_path');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
