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
        Schema::table('shop_carts', function (Blueprint $table) {
            $table->integer('quantity')->nullable()->after('user_id');
            $table->float('total_price')->nullable()->after('spot_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shop_carts', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->dropColumn('total_price');
        });
    }
};
