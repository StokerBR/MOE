<?php

namespace Database\Seeders;

use App\Models\University;
use Illuminate\Database\Seeder;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $qty = 20;

        University::create([
            'name' => 'Universidade Federal de Goiás',
        ]);

        University::factory()->count($qty)->create();

    }
}
