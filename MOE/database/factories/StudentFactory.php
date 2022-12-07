<?php

namespace Database\Factories;

use Faker\Provider\pt_BR\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $f = $this->faker;

        $f->addProvider(new Person($f));

        return [
            'name' => $f->name(),
            'email' => $f->email(),
            'state_id' => random_int(1, 27),
            'city_id' => random_int(1, 135),
            'registration' => $f->randomNumber(9, true),
            'university_id' => random_int(1, 20),
            'course_id' => random_int(1, 100),
            'course_completion' => random_int(1, 100),
            'bio' => !!random_int(0, 1) ? $f->text() : null,
        ];

    }
}
