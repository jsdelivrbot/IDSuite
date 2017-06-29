<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEndpointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('endpoint', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id');
            $table->primary('id');
            $table->string('class_code');

            $table->uuid('entity_id')->nullable();
            $table->uuid('model_id')->nullable();
            $table->uuid('proxy_id')->nullable();
            $table->uuid('location_id')->nullable();

            $table->string('username')->nullable();
            $table->char('password_hash', 64)->nullable();
            $table->string('name')->nullable();
            $table->string('ipaddress')->nullable();
            $table->string('macaddress')->nullable();
            $table->timestamp('sync_time')->nullable();
            $table->timestamp('reboot_time')->nullable();;
            $table->timestamp('last_reboot')->nullable();
            $table->string('status')->nullable();
            $table->timestamp('status_at')->nullable();
            $table->boolean('active')->nullable();
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
        Schema::dropIfExists('endpoint');
    }
}
