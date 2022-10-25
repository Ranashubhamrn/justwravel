<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->unique()->company;
        $slug = \Str::slug($title, '-');
        return [
            'title'  => $title,
            'duration'  =>  $this->faker->numberBetween($min = 1, $max = 9),
            'slug'  =>  $slug,
            'occupancy_id'  =>  $this->faker->numberBetween($min = 1, $max = 3)
        ];
    }
}
