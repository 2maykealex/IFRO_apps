<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('area_id')->unsigned(); #Eixo tecnológico
            $table->foreign('area_id')->references('id')->on('areas') ;
            $table->string('name', 150)->unique();
            $table->integer('qtSem');
            $table->integer('chCourse');
            $table->string('modalidade');
            $table->integer('chMin');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
