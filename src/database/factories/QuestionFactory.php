<?php

namespace Database\Factories;

use App\Models\Artist;
use App\Models\Country;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'description' => fake()->paragraph(),
            'answer' => fake()->numberBetween(1, 4),
            'answer_description' => fake()->paragraph(),
            'choice1' => fake()->word(),
            'choice2' => fake()->word(),
            'choice3' => fake()->word(),
            'choice4' => fake()->word(),
            'country_id' => fake()->boolean() ? Country::all()->random()->id : null,
            'artist_id' => fake()->boolean() ? Artist::all()->random()->id : null,
            'genre_id' => fake()->boolean() ? Genre::all()->random()->id : null,
        ];
    }
}
