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
            $table->string('tier_commission_3')->after('mark_up')->nullable();
            $table->string('tier_commission_2')->after('mark_up')->nullable();
            $table->string('tier_commission_1')->after('mark_up')->nullable();
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
            $table->dropColumn('tier_commission_1');
            $table->dropColumn('tier_commission_2');
            $table->dropColumn('tier_commission_3');
        });
    }
};
