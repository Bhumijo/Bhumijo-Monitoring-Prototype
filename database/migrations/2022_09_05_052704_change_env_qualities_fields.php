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
        Schema::table('environment_qualities', function (Blueprint $table) {
            $table->dropColumn('h2s');
            $table->dropColumn('nh3');
            $table->dropColumn('unit');
            $table->string('air_quality')->after('facility_id');
            $table->string('temperature')->after('air_quality');
            $table->string('humidity')->after('temperature');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('environment_qualities', function (Blueprint $table) {
            $table->dropColumn('air_quality');
            $table->dropColumn('temperature');
            $table->dropColumn('humidity');
            $table->string('h2s')->after('facility_id');
            $table->string('nh3')->after('h2s');
            $table->string('unit')->after('nh3');
        });
    }
};
