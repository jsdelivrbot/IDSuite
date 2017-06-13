<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('record', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id');
            $table->primary('id');
            $table->string('class_code');
            $table->uuid('endpoint_id')->nullable();
            $table->uuid('timeperiod_id')->nullable();
            $table->integer('local_id')->nullable();
            $table->integer('conf_id')->nullable();
            $table->string('local_name')->nullable();
            $table->string('local_number')->nullable();
            $table->string('remote_name')->nullable();
            $table->string('remote_number')->nullable();
            $table->string('dialed_digits')->nullable();
            $table->string('direction')->nullable();
            $table->string('protocol')->nullable();
            $table->timestamps();
        });

        Schema::table('record', function(Blueprint $table) {
            $table->foreign('endpoint_id')->references('id')->on('endpoint')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('timeperiod_id')->references('id')->on('timeperiod')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('record');
    }
}
