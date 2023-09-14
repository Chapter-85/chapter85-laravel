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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('import')->nullable()->change();
            $table->string('hear_about_mg')->nullable()->change();
            $table->string('phone_number')->nullable()->change();
            $table->string('nationality')->nullable()->change();
            $table->string('bank_account_name')->nullable()->change();
            $table->string('strorage_service')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('import')->nullable(false)->change();
            $table->string('hear_about_mg')->nullable(false)->change();
            $table->string('phone_number')->nullable(false)->change();
            $table->string('nationality')->nullable(false)->change();
            $table->string('bank_account_name')->nullable(false)->change();
            $table->string('strorage_service')->nullable(false)->change();
        });
    }
};
