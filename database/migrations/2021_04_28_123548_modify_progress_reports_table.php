<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyProgressReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('progress_reports', function (Blueprint $table) {
            $table->text('main_concern')->change();
            $table->unsignedBigInteger('assignee')->nullable()->after('treatment_goal');

            // foreign key
            $table->foreign('assignee')->references('id')->on('users')
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
            
            $table->dropForeign(['assignee']);
            $table->dropColumn(['assignee']);
        });
    }
}
