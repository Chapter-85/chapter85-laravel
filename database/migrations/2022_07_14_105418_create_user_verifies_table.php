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
        Schema::create('user_verifies', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('token');
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_email_verified')->default(0)->after('is_verified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_email_verified']);
        });
        Schema::dropIfExists('user_verifies');
    }
};
