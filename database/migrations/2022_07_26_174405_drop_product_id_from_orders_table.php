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
            $table->dropForeign('orders_product_id_foreign');
            $table->dropColumn('product_id');
            $table->dropColumn('spot_price');
            $table->dropColumn('total_price');
            $table->dropColumn('mark_up');
            $table->dropColumn('quantity');
            $table->text('shipping_address')->nullable()->after('delivery_method');
            // $table->text('ship_address')->nullable();
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
            $table->unsignedBigInteger('product_id')->nullable()->after('customer_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('quantity')->nullable()->after('delivery_method');
            $table->float('spot_price')->nullable()->after('product_id');
            $table->float('total_price')->nullable()->after('spot_price');
            $table->float('mark_up')->nullable()->after('total_price');
            $table->dropColumn('shipping_address');
        });
    }
};
