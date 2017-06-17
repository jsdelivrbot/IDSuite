<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntityContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entitycontact', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id');
            $table->primary('id');
            $table->string('class_code');
            $table->uuid('entityname_id')->nullable();
            $table->uuid('email_id')->nullable();
            $table->uuid('location_id')->nullable();
            $table->timestamps();
        });

        Schema::table('entitycontact', function (Blueprint $table){
            $table->foreign('entityname_id')->references('id')->on('entityname');
            $table->foreign('email_id')->references('id')->on('email');
            $table->foreign('location_id')->references('id')->on('location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entitycontact');
    }
}
