<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCancelledBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancelled_bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('cancelled_by');
            $table->unsignedSmallInteger('reason_option_id');
            $table->string('others_specify')->nullable();
            $table->timestamps();


            // foreign keys
            $table->foreign('booking_id')->references('id')->on('bookings')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('cancelled_by')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('reason_option_id')->references('id')->on('reason_options')
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
        Schema::dropIfExists('cancelled_bookings');
    }
}
