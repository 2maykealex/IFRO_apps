<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReasonRejectedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reason_rejecteds', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('certificate_id')->unsigned();
            $table->foreign('certificate_id')->references('id')->on('certificates') ;
            $table->string('description', 100)->nullable(false);

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
        Schema::dropIfExists('reason_rejecteds');
    }
}
