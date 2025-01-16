<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClientSubscriptionIdToBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('client_subscription_id')->nullable()->after('client_id');
            $table->unsignedMediumInteger('package_service_id')->nullable()->after('session_type_id');
            $table->unsignedBigInteger('accepted_by')->nullable()->after('booked_by');

            // foreign key
            $table->foreign('client_subscription_id')->references('id')->on('client_subscriptions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->foreign('package_service_id')->references('id')->on('package_services')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('accepted_by')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['client_subscription_id']);
            $table->dropForeign(['package_service_id']);
            $table->dropForeign(['accepted_by']);
            $table->dropColumn(['client_subscription_id']);
            $table->dropColumn(['package_service_id']);
            $table->dropColumn(['accepted_by']);
        });
    }
}
