<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPsychologistSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('psychologist_schedules', function (Blueprint $table) {
            $table->unsignedInteger('time_id')->nullable();
            $table->boolean('is_booked')->default(false);

            $table->foreign('time_id')->references('id')->on('time_lists')
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
            $table->dropForeign(['time_id']);
            $table->dropColumn(['time_id', 'is_booked']);
        });
    }
}
