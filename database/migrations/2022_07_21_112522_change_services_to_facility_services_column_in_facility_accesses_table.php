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
        Schema::table('facility_accesses', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn(['service_id']);
        });

        Schema::table('facility_accesses', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id')->after('user_id');
            $table->foreign('service_id')->references('id')->on('facility_services')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //drop column service_id
    }
};
