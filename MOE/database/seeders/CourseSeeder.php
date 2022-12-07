<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\University;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        Course::create([
            'name' => 'Engenharia de Software',
            'university_id' => 1,
        ]);

        $universities = University::all();
        $qty = 5;

        foreach ($universities as $university) {

            Course::factory([
                'university_id' => $university->id
            ])->count($qty)->create();

        }

    }
}
