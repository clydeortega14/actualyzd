<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_choices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('option');
            $table->string('value');
            $table->string('display_name');

            // Foreign Key
            $table->foreign('option')->references('id')->on('assessment_options')
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
        Schema::dropIfExists('option_choices');
    }
}
