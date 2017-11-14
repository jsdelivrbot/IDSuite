<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEndpointEntity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('endpoint_entity', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('entity_id');
            $table->uuid('endpoint_id');
            $table->timestamps();
        });

        Schema::table('endpoint_entity', function(Blueprint $table){
            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('endpoint_id')->references('id')->on('endpoint')->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endpoint_entity');
    }
}
