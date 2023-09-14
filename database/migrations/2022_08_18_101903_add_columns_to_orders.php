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
            $table->unsignedBigInteger('delivery_method_id')->nullable()->after('delivery_method');
            $table->foreign('delivery_method_id')->references('id')->on('setups');
            $table->unsignedBigInteger('payment_method_id')->nullable()->after('payment_method');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->date('payment_due_date')->nullable()->after('shipping_address');
            $table->string('payment_status')->nullable()->after('payment_due_date');
            $table->string('order_status')->nullable()->after('payment_status');
            $table->string('delivery_status')->nullable()->after('order_status');

            $table->dropColumn('delivery_method');
            $table->dropColumn('payment_method');
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
            $table->dropForeign('orders_delivery_method_id_foreign');
            $table->dropForeign('orders_payment_method_id_foreign');
            $table->dropColumn('delivery_method_id');
            $table->dropColumn('payment_due_date');
            $table->dropColumn('payment_method_id');
            $table->dropColumn('order_status');
            $table->dropColumn('payment_status');
            $table->dropColumn('delivery_status');
        });
    }
};
