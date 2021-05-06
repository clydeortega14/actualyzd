<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_services', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedInteger('package_id');
            $table->unsignedSmallInteger('session_type_id');
            $table->integer('limit');
            $table->timestamps();

            // foreign keys
            $table->foreign('package_id')->references('id')->on('packages')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('session_type_id')->references('id')->on('session_types')
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
        Schema::dropIfExists('package_services');
    }
}
