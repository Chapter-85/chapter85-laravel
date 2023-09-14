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
        Schema::table('product_commissions', function (Blueprint $table) {
            $table->string('product_price')->after('product_id')->nullable();
            $table->float('tier_commission_percentage')->after('product_price')->nullable();
            $table->float('product_mark_up')->after('tier_commission')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_commissions', function (Blueprint $table) {
            $table->dropColumn('product_price');
            $table->dropColumn('tier_commission_percentage');
            $table->dropColumn('product_mark_up');
        });
    }
};
