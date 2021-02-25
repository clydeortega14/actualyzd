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
            $table->unsignedSmallInteger('status')->nullable();
            $table->unsignedBigInteger('book_with')->nullable();

            //foreign
            $table->foreign('time')->references('id')->on('time_lists')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('status')->references('id')->on('psycho_sched_statuses')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('book_with')->references('id')->on('users')
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
            $table->dropColumn(['time', 'status', 'users']);
        });
    }
}
