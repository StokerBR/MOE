<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('fantasy_name', 100);
            $table->string('social_reason', 100);
            $table->string('cnpj', 18);
            $table->string('email', 100);
            $table->string('password', 60);
            $table->integer('state_id');
            $table->integer('city_id');
            $table->text('additional_info')->nullable();
            $table->boolean('blocked')->default(false);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
