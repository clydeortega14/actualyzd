<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->text('link_to_session')->nullable()->after('status');
            $table->unsignedSmallInteger('main_concern')->after('link_to_session')->nullable();

            //foreign
            $table->foreign('main_concern')->references('id')->on('assessment_categories')
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
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['main_concern']);
            $table->dropColumn(['link_to_session', 'main_concern']);
        });
    }
}
