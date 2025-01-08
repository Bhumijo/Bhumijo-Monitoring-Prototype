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
        Schema::table('facility_services', function (Blueprint $table) {
            $table->string('section')->after('service_id');
            $table->string('user_type')->after('section');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facility_services', function (Blueprint $table) {
            $table->dropColumn('section');
            $table->dropColumn('user_type');
        });
    }
};
