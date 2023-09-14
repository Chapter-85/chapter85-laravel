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
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropColumn('availabe_units');
            $table->dropColumn('balance');
            $table->unsignedBigInteger('order_id')->nullable()->after('product_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->integer('units')->nullable()->after('order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->float('availabe_units')->after('product_id')->nullable();
            $table->float('balance')->after('availabe_units')->nullable();
            $table->dropForeign('inventories_order_id_foreign');
            $table->dropColumn('order_id');
            $table->dropColumn('units');
        });
    }
};
