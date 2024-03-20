<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientSubscriptionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_subscription_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_subscription_id');
            $table->string('reference_no')->nullable();
            $table->decimal('amount', 19, 4);
            $table->boolean('paid')->default(false);
            $table->unsignedSmallInteger('subscription_status_id');
            $table->timestamps();

            $table->foreign('client_subscription_id')->references('id')->on('client_subscriptions')
                ->onDelete('cascade')->onUpdate('cascade');


            $table->foreign('subscription_status_id')->references('id')->on('subscription_statuses')
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
        Schema::dropIfExists('client_subscription_histories');
    }
}
