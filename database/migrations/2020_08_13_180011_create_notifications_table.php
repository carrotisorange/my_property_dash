<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('notification_id');
            $table->unsignedBigInteger('notification_tenant_id');
            $table->unsignedBigInteger('notification_room_id');
            $table->unsignedBigInteger('notification_user_id');
            $table->string('action');
            $table->timestamps();

            $table->foreign('notification_tenant_id')->references('tenant_id')
            ->on('tenants')->onDelete('cascade');

            $table->foreign('notification_room_id')->references('unit_id')
            ->on('units')->onDelete('cascade');

            $table->foreign('notification_user_id')->references('id')
            ->on('users')->onDelete('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
