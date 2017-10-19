<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandTable extends Migration
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

            $table->uuid('endpoint_id')->nullable();
            $table->string("command")->nullable();
            $table->string("command_type")->nullable();
            $table->text("payload")->nullable();
            $table->text("raw_command")->nullable();
            $table->text('output')->nullable();
            $table->integer('status')->default(0);
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
        //
    }
}
