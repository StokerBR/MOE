<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Internship;
use App\Models\InternshipCourse;
use Illuminate\Database\Seeder;

class InternshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $qty = 20;

        $countCourses = Course::count();

        for ($i = 0; $i < $qty; $i++) {

            $internship = Internship::factory()->create();

            $courses = randomArrayUniqueNumbers(1, $countCourses);
            array_splice($courses, -random_int(0, 10));
            foreach($courses as $courseId) {

                InternshipCourse::create([
                    'internship_id' => $internship->id,
                    'course_id' => $courseId
                ]);

            }

        }

    }
}
