<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('schedule');
            $table->unsignedInteger('time_id');
            $table->unsignedBigInteger('counselee')->nullable();
            $table->unsignedBigInteger('booked_by');
            $table->unsignedSmallInteger('session_type_id');
            $table->unsignedSmallInteger('status');
            $table->timestamps();


            // foreign keys
            $table->foreign('schedule')->references('id')->on('psychologist_schedules')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('time_id')->references('id')->on('time_lists')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('counselee')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('booked_by')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('session_type_id')->references('id')->on('session_types')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('status')->references('id')->on('booking_statuses')
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
        Schema::dropIfExists('bookings');
    }
}
