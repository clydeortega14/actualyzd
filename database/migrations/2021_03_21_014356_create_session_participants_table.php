<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_participants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('participant');
            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('bookings')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('participant')->references('id')->on('users')
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
        Schema::dropIfExists('session_participants');
    }
}
