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
            $table->dropColumn('tier_1_id');
            $table->dropColumn('tier_2_id');
            $table->dropColumn('tier_3_id');
            $table->dropColumn('tier_1_price');
            $table->dropColumn('tier_2_price');
            $table->dropColumn('tier_3_price');
            $table->string('tier_type')->nullable()->after('product_id');
            $table->unsignedBigInteger('tier_id')->nullable()->after('tier_type');
            $table->float('tier_commission')->nullable()->after('tier_id');
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
            $table->unsignedBigInteger('tier_1_id')->nullable();
            $table->unsignedBigInteger('tier_2_id')->nullable();
            $table->unsignedBigInteger('tier_3_id')->nullable();
            $table->float('tier_1_price')->nullable();
            $table->float('tier_2_price')->nullable();
            $table->float('tier_3_price')->nullable();
            $table->dropColumn('tier_type');
            $table->dropColumn('tier_id');
            $table->dropColumn('tier_commission');
        });
    }
};
