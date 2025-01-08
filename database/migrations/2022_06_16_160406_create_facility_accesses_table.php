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
        Schema::create('facility_accesses', function (Blueprint $table) {
            $table->id();
            $table->string('user_type');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('service_id')->constrained('services');
            $table->string('gender');
            $table->float('price');
            $table->boolean('is_subscribed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facility_accesses');
    }
};
