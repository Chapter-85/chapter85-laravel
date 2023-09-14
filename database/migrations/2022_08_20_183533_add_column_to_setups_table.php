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
        Schema::table('setups', function (Blueprint $table) {
            $table->string('delivery_method_ch')->nullable()->after('delivery_method');
            $table->string('delivery_method_s_ch')->nullable()->after('delivery_method_ch');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setups', function (Blueprint $table) {
            $table->dropColumn('delivery_method_ch');
            $table->dropColumn('delivery_method_s_ch');
        });
    }
};
