<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCounseleeToProgressReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('progress_reports', function (Blueprint $table) {
            $table->unsignedBigInteger('counselee')->nullable()->after('booking_id');


            $table->foreign('counselee')->references('id')->on('users')
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
        Schema::table('progress_reports', function (Blueprint $table) {
            $table->dropForeign(['counselee']);
            $table->dropColumn('counselee');
        });
    }
}
