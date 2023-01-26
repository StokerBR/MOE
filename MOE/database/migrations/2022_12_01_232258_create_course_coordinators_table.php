<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseCoordinatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_coordinators', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('cpf', 14);
            $table->string('email', 100);
            $table->string('password', 60);
            $table->integer('university_id');
            $table->integer('course_id');
            $table->boolean('approved')->nullable();
            $table->boolean('blocked')->default(false);
            $table->rememberToken();
            $table->timestamps();

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
        Schema::dropIfExists('course_coordinators');
    }
}
