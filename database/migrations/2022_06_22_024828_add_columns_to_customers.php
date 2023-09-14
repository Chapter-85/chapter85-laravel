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
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->string('full_name')->after('id')->nullable();
            $table->string('occupation')->after('user_id')->nullable();
            $table->text('address')->after('occupation')->nullable();
            $table->string('business_name')->after('address')->nullable();
            $table->string('type_of_organization')->after('business_name')->nullable();
            $table->string('business_phone_num')->after('type_of_organization')->nullable();
            $table->string('business_fax')->after('business_phone_num')->nullable();
            $table->string('business_email')->after('business_fax')->nullable();
            $table->text('business_address')->after('business_email')->nullable();
            $table->string('city')->after('business_address')->nullable();
            $table->string('country')->after('city')->nullable();
            $table->string('zip_code')->after('country')->nullable();
            $table->string('type_of_business')->after('zip_code')->nullable();
            $table->string('retails')->after('zip_code')->nullable();
            $table->string('business_reg_num')->after('type_of_business')->nullable();
            $table->string('country_of_incorporation')->after('business_reg_num')->nullable();
            $table->string('years_in_business')->after('country_of_incorporation')->nullable();
            $table->boolean('import')->default(0)->after('years_in_business');
            $table->text('countries_of_import')->nullable()->after('import');
            $table->boolean('hear_about_mg')->default(0)->after('countries_of_import');
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
            $table->string('first_name');
            $table->string('last_name');
            $table->dropColumn('full_name');
            $table->dropColumn('occupation');
            $table->dropColumn('address');
            $table->dropColumn('business_name');
            $table->dropColumn('type_of_organization');
            $table->dropColumn('business_phone_num');
            $table->dropColumn('business_fax');
            $table->dropColumn('business_address');
            $table->dropColumn('business_email');
            $table->dropColumn('retails');
            $table->dropColumn('zip_code');
            $table->dropColumn('city');
            $table->dropColumn('country');
            $table->dropColumn('type_of_business');
            $table->dropColumn('business_reg_num');
            $table->dropColumn('country_of_incorporation');
            $table->dropColumn('years_in_business');
            $table->dropColumn('import');
            $table->dropColumn('countries_of_import');
            $table->dropColumn('hear_about_mg');
        });
    }
};
