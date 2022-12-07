<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
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

        Student::create([
            'name' => 'Aluno MOE',
            'email' => 'aluno@moe.com',
            'password' => $moeHash,
            'state_id' => 10,
            'city_id' => 1,
            'registration' => '201905533',
            'university_id' => 1,
            'course_id' => 1,
            'course_completion' => 60,
        ]);

        Student::factory([
            'password' => $moeHash
        ])->count($qty)->create();

    }
}
