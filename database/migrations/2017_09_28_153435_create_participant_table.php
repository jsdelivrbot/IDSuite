<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('participant', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->uuid('id');
            $table->primary('id');
            $table->string('class_code');

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('type')->nullable();
            $table->boolean('muted')->nullable();


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
        Schema::dropIfExists('participant');
    }
}
