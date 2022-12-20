<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('password', 60);
            $table->integer('state_id');
            $table->integer('city_id');
            $table->string('registration', 100);
            $table->integer('university_id');
            $table->integer('course_id');
            $table->integer('course_completion')->nullable();
            $table->text('bio')->nullable();
            $table->boolean('blocked')->default(false);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('university_id')->references('id')->on('universities');
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
        Schema::dropIfExists('students');
    }
}
