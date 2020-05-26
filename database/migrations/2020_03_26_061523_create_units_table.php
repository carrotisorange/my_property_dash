<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->bigIncrements('unit_id');
            $table->string('unit_no',10);
            $table->integer('unit_unit_owner_id')->unsigned()->nullable();
            $table->foreign('unit_unit_owner_id')->references('unit_owner_id')->on('unit_owners');
            $table->integer('floor_no');
            $table->integer('beds');
            $table->float('monthly_rent', 8,2);
            $table->float('egr', 8,2);
            $table->string('status')->default('vacant');
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
        Schema::dropIfExists('units');
    }
}
