<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->bigIncrements('billing_id');
            $table->integer('billing_tenant_id')->unsigned()->nullable();
            $table->foreign('billing_tenant_id')->references('tenant_id')->on('tenants');
            $table->date('billing_date');
            $table->string('billing_desc');
            $table->double('billing_amt', 8, 2);
            $table->string('billing_status')->default('unpaid');
            $table->string('details');
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
        Schema::dropIfExists('billings');
    }
}
