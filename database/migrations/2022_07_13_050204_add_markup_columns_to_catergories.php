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
        Schema::table('catergories', function (Blueprint $table) {
            $table->string('surcharge_at_category')->nullable()->after('parent_id');
            $table->string('markup_type')->nullable()->after('surcharge_at_category');
            $table->float('mark_up')->nullable()->after('markup_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catergories', function (Blueprint $table) {
            $table->dropColumn('surcharge_at_category');
            $table->dropColumn('markup_type');
            $table->dropColumn('mark_up');
        });
    }
};
