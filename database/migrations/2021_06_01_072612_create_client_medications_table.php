<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_medications', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedBigInteger('report_id');
            $table->text('medication');
            $table->timestamps();

            // foreign key
            $table->foreign('report_id')->references('id')->on('progress_reports')
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
        Schema::dropIfExists('client_medications');
    }
}
