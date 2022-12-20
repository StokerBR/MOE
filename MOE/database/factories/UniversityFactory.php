<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UniversityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $f = $this->faker;

        $name = $f->sentence(3, false);

        $acronym = '';

        foreach (explode(' ', $name) as $n) {
            $acronym .= strtoupper($n[0]);
        }

        return [
            'name' => $name,
            'acronym' => $acronym,
            'state_id' => random_int(1, 27),
            'city_id' => random_int(1, 135),
        ];
    }
}
