<?php

namespace Database\Factories;

use Faker\Provider\pt_BR\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {

        $f = $this->faker;

        $f->addProvider(new Company($f));

        $name = $f->company();

        return [
            'fantasy_name' => $name,
            'social_reason' => $name.' '.$f->companySuffix(),
            'cnpj' => $f->cnpj(),
            'email' => $f->companyEmail(),
            'state_id' => random_int(1, 27),
            'city_id' => random_int(1, 135),
            'additional_info' => !!random_int(0, 1) ? $f->text() : null
        ];
    }
}
