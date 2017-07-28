<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEndpointmodelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('endpointmodel', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id');
            $table->primary('id');
            $table->string('class_code');
            $table->string('manufacturer')->nullable();
            $table->string('manpnumber')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('edition')->nullable();
            $table->integer('type')->nullable();
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
