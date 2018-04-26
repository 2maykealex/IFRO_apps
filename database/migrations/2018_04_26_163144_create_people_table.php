<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;
use App\Models\City;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users') ;
            $table->string('name', 100);
            
            $table->string('address', 150);
            $table->string('number', 10);
            $table->string('complement', 60);
            $table->string('neighborhood', 60);
            $table->string('zipCode', 10);

            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities') ;

            $table->string('tel', 15);
            $table->string('cel', 15);

            

                       


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
        Schema::dropIfExists('people');
    }
}
