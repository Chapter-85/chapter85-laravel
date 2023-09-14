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
            $table->string('mark_up_type')->nullable()->after('product_mark_up');
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
            $table->dropColumn('mark_up_type');
        });
    }
};
