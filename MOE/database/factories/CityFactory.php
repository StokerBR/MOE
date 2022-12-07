<?php

namespace Database\Factories;

use Faker\Provider\pt_BR\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        
        $f = $this->faker;

        $f->addProvider(new Address($f));

        return [
            'name' => $f->city()
        ];

    }
}
