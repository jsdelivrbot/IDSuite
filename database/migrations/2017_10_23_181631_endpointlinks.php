<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Endpointlinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::enableForeignKeyConstraints();

        Schema::create('endpointlinks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id');
            $table->primary('id');
            $table->string('class_code');
            $table->integer('endpoint_id');

            $table->integer('method'); // 0 single customer, 1 multicustomer
            $table->string('external_id'); // example: tenantname: ASU, gateways, asugateways
            $table->string('entitiy_id'); // internal customer (entityid)


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
        Schema::dropIfExists('endpointmodel');

    }
}
