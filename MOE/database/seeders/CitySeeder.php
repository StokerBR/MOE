<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        City::create([
            'name' => 'Goiânia',
            'state_id' => 10,
        ]);

        $states = State::all();
        $qty = 10;

        foreach ($states as $state) {

            City::factory([
                'state_id' => $state->id
            ])->count($qty)->create();

        }

    }
}
