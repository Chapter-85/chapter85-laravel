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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('phone_number');
            $table->string('nationality');
            $table->string('passport_no')->nullable();
            $table->string('bank_account_name');
            $table->string('bank_account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_branch_number')->nullable();
            $table->string('bank_country_name')->nullable();
            $table->string('bank_swift_code')->nullable();
            $table->string('sales_rep_name')->nullable();
            $table->string('sales_rep_number')->nullable();
            $table->string('sales_rep_country')->nullable();
            $table->string('strorage_service')->default('false');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
