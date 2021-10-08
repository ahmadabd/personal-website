<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'         => $this->faker->randomElement(['title test']),
            'descriptions'  => $this->faker->randomElement(['description test']),
            'url'           => $this->faker->randomElement(['http://www.google.com'])
        ];
    }
}
