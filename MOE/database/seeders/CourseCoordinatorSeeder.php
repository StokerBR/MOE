<?php

namespace Database\Seeders;

use App\Models\CourseCoordinator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CourseCoordinatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $qty = 20;

        $moeHash = Hash::make('moe');

        CourseCoordinator::create([
            'name' => 'Coordenador MOE',
            'cpf' => '798.617.120-03',
            'email' => 'coordenador@moe.com',
            'password' => $moeHash,
            'university_id' => 1,
            'course_id' => 1,
        ]);

        CourseCoordinator::factory([
            'password' => $moeHash
        ])->count($qty)->create();

    }
}
