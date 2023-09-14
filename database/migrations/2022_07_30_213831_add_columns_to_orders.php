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
            $table->string('full_name')->nullable()->after('total_order_price');
            $table->string('phone_number')->nullable()->after('full_name');
            $table->string('email')->nullable()->after('phone_number');
            $table->string('city')->nullable()->after('email');
            $table->string('country')->nullable()->after('city');
            $table->string('zip_code')->nullable()->after('country');
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
            $table->dropColumn('full_name');
            $table->dropColumn('phone_number');
            $table->dropColumn('email');
            $table->dropColumn('city');
            $table->dropColumn('country');
            $table->dropColumn('zip_code');
        });
    }
};
