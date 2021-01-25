<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToPsychoSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('psychologist_schedules', function (Blueprint $table) {
            $table->unsignedSmallInteger('status')->after('is_active');

            $table->foreign('status')->references('id')->on('psycho_sched_statuses')->onDelete('cascade')->onUpdate('cascade');
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
            $table->dropForeign('psychologist_schedules_status_foreign');
            $table->dropColumn('status');
        });
    }
}
