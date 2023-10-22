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
            $table->unsignedBigInteger('product_size_id')->after('product_id')->nullable();
            $table->foreign('product_size_id')->references('id')->on('product_sizes');
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
            //
        });
    }
};
