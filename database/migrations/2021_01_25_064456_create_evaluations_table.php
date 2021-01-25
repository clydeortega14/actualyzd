<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedInteger('psychologist');
            $table->unsignedInteger('statement');
            $table->unsignedSmallInteger('rate');
            $table->unsignedBigInteger('evaluator');
            $table->timestamps();

            // Psychologist foreign key
            $table->foreign('psychologist')->references('id')->on('psychologists')->onDelete('cascade')->onUpdate('cascade');

            // Feed Back Forms foreign key
            $table->foreign('statement')->references('id')->on('feed_backs')->onDelete('cascade')->onUpdate('cascade');

            // Rate List foreign key
            $table->foreign('rate')->references('id')->on('rate_lists')->onDelete('cascade')->onUpdate('cascade');

            // Evaluator Foreign key
            $table->foreign('evaluator')->references('id')->on('users')->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
}
