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
        Schema::table('facility_expenses', function (Blueprint $table) {
            $table->float('amount', 12, 2)->after('type')->change();
        });

        Schema::table('facility_services', function (Blueprint $table) {
            $table->float('price', 12, 2)->after('service_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facility_expenses', function (Blueprint $table) {
            $table->float('amount')->after('type')->change();
        });

        Schema::table('facility_services', function (Blueprint $table) {
            $table->float('price')->after('service_id')->change();
        });
    }
};
