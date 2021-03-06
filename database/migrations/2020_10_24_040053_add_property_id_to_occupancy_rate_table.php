<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPropertyIdToOccupancyRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('occupancy_rate', function (Blueprint $table) {
            $table->uuid('property_id_foreign')->nullable();
            $table->foreign('property_id_foreign')->references('property_id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('occupancy_rate', function (Blueprint $table) {
            $table->dropForeign('property_id_foreign');
        });
    }
}
