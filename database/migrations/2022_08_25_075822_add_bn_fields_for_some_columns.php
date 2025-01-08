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
        Schema::table('recharge_packages', function (Blueprint $table) {
            $table->string('title_bn')->after('title');
        });

        Schema::table('facilities', function (Blueprint $table) {
            $table->string('navigation_note_bn')->after('navigation_note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recharge_packages', function (Blueprint $table) {
            $table->dropColumn('title_bn');
        });

        Schema::table('facilities', function (Blueprint $table) {
            $table->dropColumn('navigation_note_bn');
        });
    }
};
