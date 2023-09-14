<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_remarks')->nullable()->after('payment_status');
            $table->unsignedBigInteger('payment_status_updated_by')->nullable()->after('payment_remarks');
            $table->foreign('payment_status_updated_by')->references('id')->on('users');
            $table->string('delivery_remarks')->nullable()->after('delivery_status');
            $table->unsignedBigInteger('delivery_status_updated_by')->nullable()->after('delivery_remarks');
            $table->foreign('delivery_status_updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_payment_status_updated_by_foreign');
            $table->dropForeign('orders_delivery_status_updated_by_foreign');
            $table->dropColumn('payment_remarks');
            $table->dropColumn('payment_status_updated_by');
            $table->dropColumn('delivery_remarks');
            $table->dropColumn('delivery_status_updated_by');
        });
    }
};
