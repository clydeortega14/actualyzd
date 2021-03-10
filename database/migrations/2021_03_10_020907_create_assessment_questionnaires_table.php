<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_questionnaires', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('category');
            $table->text('question');
            $table->unsignedSmallInteger('option');
            $table->timestamps();


            $table->foreign('category')->references('id')->on('assessment_categories')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('option')->references('id')->on('assessment_options')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessment_questionnaires');
    }
}
