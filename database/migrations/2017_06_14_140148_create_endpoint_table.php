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

            $table->string('manufacturer')->nullable();
            $table->string('username')->nullable();
            $table->char('password_hash', 64)->nullable();
            $table->string('name')->nullable();
            $table->string('ipaddress')->nullable();
            $table->string('macaddress')->nullable();
            $table->time('sync_time')->nullable();
            $table->time('reboot_time')->nullable();;
            $table->time('last_reboot')->nullable();
            $table->string('status')->nullable();
            $table->string('model_type')->nullable();
            $table->time('status_at')->nullable();
            $table->boolean('active')->nullable();
            $table->timestamps();


        });


        Schema::table('endpoint', function (Blueprint $table){
            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('model_id')->references('id')->on('endpointmodel')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('proxy_id')->references('id')->on('proxy')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('location_id')->references('id')->on('location')->onDelete('cascade')->onUpdate('cascade');
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
