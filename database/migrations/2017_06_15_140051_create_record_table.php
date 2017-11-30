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

            $table->string('local_id')->nullable();
            $table->uuid('row_hash')->nullable();

            $table->uuid('endpoint_id')->nullable();
            $table->uuid('entity_id')->nullable();

            $table->uuid('type')->nullable();
            $table->uuid('timeperiod_id')->nullable();
            $table->uuid('remote_location_id')->nullable();

            $table->string('conference_id')->nullable();
            $table->string('local_name')->nullable();
            $table->string('local_number')->nullable();
            $table->string('remote_name')->nullable();
            $table->string('remote_number')->nullable();
            $table->string('dialed_digits')->nullable();
            $table->string('direction')->nullable();
            $table->string('protocol')->nullable();

            $table->boolean('active')->nullable();

            $table->timestamps();

            $table->unique(['endpoint_id', 'local_id']);

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
