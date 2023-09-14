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
        Schema::table('products', function (Blueprint $table) {
            $table->string('sku')->after('id')->nullable();
            $table->string('pricing_type')->after('description')->nullable();
            $table->float('fixed_amount')->after('pricing_type')->nullable();
            $table->float('promo_amount')->after('fixed_amount')->nullable();
            $table->float('buy_back_amount')->after('promo_amount')->nullable();
            $table->string('surcharge_at_product')->after('buy_back_amount')->nullable();
            $table->dropColumn('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('pricing_type');
            $table->dropColumn('fixed_amount');
            $table->dropColumn('promo_amount');
            $table->dropColumn('buy_back_amount');
            $table->dropColumn('surcharge_at_product');
            $table->string('type')->after('description')->nullable();
        });
    }
};
