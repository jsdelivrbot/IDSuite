<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('ticket', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->primary('id');
            $table->uuid('id');

            $table->uuid('entity_id')->nullable(); // customer
            $table->uuid('user_id')->nullable(); //assigned

            //$table->integer('origin_type')->nullable();
            $table->integer('ticket_type')->nullable();
            $table->integer('priority_type')->nullable();
            $table->integer('status_type')->nullable();

            $table->string('class_code');
            $table->string('subject')->nullable();
            $table->text('message_in')->nullable();
            $table->text('message_out')->nullable();

            $table->dateTime('ticket_date')->nullable();
            $table->dateTime('last_message_date')->nullable();

            $table->boolean('known')->nullable();
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
        Schema::dropIfExists('ticket');
    }
}
