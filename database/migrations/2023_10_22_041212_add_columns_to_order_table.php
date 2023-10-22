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
            $table->unsignedBigInteger('customer_id')->change()->nullable();
            $table->unsignedBigInteger('walk_in_customer_id')->nullable()->after('customer_id');
            $table->foreign('walk_in_customer_id')->references('id')->on('walk_in_customers');
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
            $table->dropForeign('orders_walk_in_customer_id_foreign');
            $table->dropColumn('walk_in_customer_id');
        });
    }
};
