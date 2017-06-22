<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProxyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('proxy', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id');
            $table->primary('id');
            $table->string('class_code');

            $table->uuid('entity_id')->nullable();
            $table->uuid('location_id')->nullable();

            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('port')->nullable();
            $table->string('target')->nullable();
            $table->string('token')->nullable();
            $table->string('key')->nullable();
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
        Schema::dropIfExists('proxy');
    }
}
