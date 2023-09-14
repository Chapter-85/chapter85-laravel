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
            $table->string('weight_unit')->after('markup_type')->nullable();
            $table->float('weight_in_grams')->after('weight_unit')->nullable();
            $table->string('session_duration')->after('valid_till')->nullable();
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
            $table->dropColumn('weight_unit');
            $table->dropColumn('weight_in_grams');
            $table->dropColumn('session_duration');
        });
    }
};
