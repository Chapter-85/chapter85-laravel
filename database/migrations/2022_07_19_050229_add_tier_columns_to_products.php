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
            $table->float('tier_commission_1')->nullable()->change();
            $table->float('tier_commission_2')->nullable()->change();
            $table->float('tier_commission_3')->nullable()->change();
            $table->float('tier_commission_4')->nullable()->after('tier_commission_3');
            $table->float('tier_commission_5')->nullable()->after('tier_commission_4');
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
            $table->string('tier_commission_1')->nullable()->change();
            $table->string('tier_commission_2')->nullable()->change();
            $table->string('tier_commission_3')->nullable()->change();
            $table->dropColumn('tier_commission_4');
            $table->dropColumn('tier_commission_5');
        });
    }
};
