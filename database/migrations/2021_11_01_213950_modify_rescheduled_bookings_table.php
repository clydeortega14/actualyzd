<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyRescheduledBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rescheduled_bookings', function (Blueprint $table) {
            $table->unsignedSmallInteger('reason_option_id')->nullable()->after('updated_by');

            // foreign key
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
        Schema::table('rescheduled_bookings', function (Blueprint $table) {
            $table->dropForeign(['reason_option_id']);
            $table->dropColumn(['reason_option_id']);
        });
    }
}
