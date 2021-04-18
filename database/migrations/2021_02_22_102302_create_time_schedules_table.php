<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('schedule');
            $table->unsignedInteger('time');
            $table->boolean('is_booked')->default(0);
            $table->timestamps();

            //foreign key
            $table->foreign('schedule')->references('id')->on('psychologist_schedules')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('time')->references('id')->on('time_lists')
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
        Schema::dropIfExists('time_schedules');
    }
}
