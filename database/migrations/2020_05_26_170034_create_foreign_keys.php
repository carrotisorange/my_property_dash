<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('units', function(Blueprint $table){
            $table->foreign('unit_unit_owner_id')->references('unit_owner')
                ->on('unit_owners')->onDelete('cascade');
        });

        Schema::table('tenants', function(Blueprint $table){
            $table->foreign('unit_tenant_id')->references('unit_id')
                ->on('units')->onDelete('cascade');
        });

        Schema::table('billings', function(Blueprint $table){
            $table->foreign('billing_tenant_id')->references('tenant_id')
                ->on('tenants')->onDelete('cascade');
        });

        Schema::table('payments', function(Blueprint $table){
            $table->foreign('payment_tenant_id')->references('tenant_id')
                ->on('tenants')->onDelete('cascade');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('units', function(Blueprint $table){
            $table->dropForeign('unit_unit_owner_id');
        });

        Schema::table('tenants', function (Blueprint $table) {
            $table->dropForeign('unit_tenant_id');
        });

        Schema::table('billings', function (Blueprint $table) {
            $table->dropForeign('billing_tenant_id');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign('payment_tenant_id');
        });

 
    }
}
