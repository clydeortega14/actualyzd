<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePsychologistSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psychologist_schedules', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedInteger('psycho_id');
            $table->datetime('schedule');
            $table->boolean('is_active');

            //foreign key 
            $table->foreign('psycho_id')->references('id')->on('psychologists')
                ->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('psychologist_schedules');
    }
}
