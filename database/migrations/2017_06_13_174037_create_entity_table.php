<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::enableForeignKeyConstraints();

        Schema::create('entity', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id');
            $table->primary('id');
            $table->string('class_code');
            $table->uuid('contact_id')->nullable();
            $table->uuid('parent_id')->nullable();
            $table->uuid('user_id')->nullable();
            $table->boolean('active')->nullable();
            $table->timestamps();
        });

        Schema::table('entity', function(Blueprint $table){
            $table->foreign('contact_id')->references('id')->on('entitycontact');
            $table->foreign('parent_id')->references('id')->on('entity');
            $table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity');
    }
}
