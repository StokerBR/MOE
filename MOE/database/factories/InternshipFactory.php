<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InternshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $f = $this->faker;

        $shifts = ['m', 'v', 'i'];

        return [
            'title' => $f->sentence(4),
            'description' => $f->text(),
            'assignments' => $f->text(),
            'work_model' => !!random_int(0, 1) ? 'r' : 'p',
            'remuneration' => !!random_int(0, 1) ? $f->randomFloat(2, 0, 2000) : null,
            'completion' => random_int(0, 100),
            'desired_abilities' => $f->text(),
            'shift' => $shifts[random_int(0, 2)],
            'state_id' => random_int(1, 27),
            'city_id' => random_int(1, 135),
        ];

    }
}
