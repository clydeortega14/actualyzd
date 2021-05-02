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
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('participant');

            $table->foreign('booking_id')->references('id')->on('bookings')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('participant')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->primary(['booking_id', 'participant']);
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
