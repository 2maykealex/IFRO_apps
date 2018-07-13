<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsInvalidedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_invalideds', function (Blueprint $table) {
            $table->increments('id');

            //usuário do Coordenador que cadastrou o aluno - Obter o curso do professor
            $table->integer('coord_user_id')->unsigned();
            $table->foreign('coord_user_id')->references('id')->on('users') ;

            $table->string('name', '50');
            $table->string('cpf', 11);
            $table->string('telefones', 100);

            $table->string('registration', 20);
            $table->string('group', 50);
            $table->boolean('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_invalideds');
    }
}
