<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounselingSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counseling_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedMediumInteger('psycho_sched_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedSmallInteger('counseling_type_id');
            $table->unsignedSmallInteger('channel');
            $table->unsignedSmallInteger('status');
            $table->timestamps();

            // foreign key

            // Psychologist Schedues foreign key
            $table->foreign('psycho_sched_id')->references('id')->on('psychologist_schedules')->onDelete('cascade')->onUpdate('cascade');

            // Users Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            // Counseling types foreign key
            $table->foreign('counseling_type_id')->references('id')->on('counseling_types')->onDelete('cascade')->onUpdate('cascade');

            // Channels foreign key
            $table->foreign('channel')->references('id')->on('channels')->onDelete('cascade')->onUpdate('cascade');

            // Counseling statuses foreign key
            $table->foreign('status')->references('id')->on('counseling_statuses')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counseling_schedules');
    }
}
