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
            $table->integer('type')->nullable();
            $table->integer('e_many')->default(0)->nullable(); // many entities?

           // $table->char('password', 160)->nullable();
            $table->char('links', 160)->nullable();

            //$table->string('username')->nullable();
            $table->string('name')->nullable();
            $table->string('ipaddress')->nullable();
          //  $table->string('macaddress')->nullable();

            $table->time('sync_time')->nullable();
            $table->time('reboot_time')->nullable();;

            $table->dateTime('last_reboot')->nullable();
            $table->dateTime('status_at')->nullable();

            $table->integer('status')->nullable();

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
