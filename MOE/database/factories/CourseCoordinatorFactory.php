<?php

namespace Database\Factories;

use Faker\Provider\pt_BR\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseCoordinatorFactory extends Factory
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
            'cpf' => $f->cpf(),
            'email' => $f->email(),
            'university_id' => random_int(1, 20),
            'course_id' => random_int(1, 100),
        ];

    }
}
