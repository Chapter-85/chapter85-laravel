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
            $table->string('name_t_ch')->nullable()->after('name');
            $table->string('name_s_ch')->nullable()->after('name_t_ch');
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
            $table->dropColumn('name_t_ch');
            $table->dropColumn('name_s_ch');
        });
    }
};
