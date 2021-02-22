<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimeToPsychologistSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('psychologist_schedules', function (Blueprint $table) {
            $table->unsignedInteger('time');

            //foreign
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
        Schema::table('psychologist_schedules', function (Blueprint $table) {
            $table->dropForeign('psychologist_schedules_time_foreign');
            $table->dropColumn('time');
        });
    }
}
