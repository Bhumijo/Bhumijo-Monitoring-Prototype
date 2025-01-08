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
        Schema::create('user_subscription_packages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('subscription_package_id')->unsigned();
            $table->foreign('subscription_package_id')->references('id')->on('subscription_packages')->onDelete('cascade');
            $table->bigInteger('facility_id')->unsigned();
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
            $table->integer('can_be_used');
            $table->integer('has_been_used')->default(0);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->bigInteger('recharged_by')->nullable()->unsigned();
            $table->foreign('recharged_by')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('is_expired')->default(false);
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
        Schema::dropIfExists('user_subscription_packages');
    }
};
