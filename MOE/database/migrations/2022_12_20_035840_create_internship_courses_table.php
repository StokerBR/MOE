<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternshipCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internship_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('internship_id');
            $table->foreignId('course_id');
            $table->boolean('approved')->nullable();

            $table->foreign('internship_id')->references('id')->on('internships');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internship_courses');
    }
}
