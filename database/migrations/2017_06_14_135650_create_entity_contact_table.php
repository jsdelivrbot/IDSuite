<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntityContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('entitycontact', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id');
            $table->primary('id');
            $table->string('class_code');
            $table->uuid('entityname_id')->index()->nullable();
            $table->uuid('email_id')->index()->nullable();
            $table->uuid('location_id')->index()->nullable();
            $table->uuid('phonenumber_id')->index()->nullable();
            $table->uuid('website_id')->index()->nullable();
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
        Schema::dropIfExists('entitycontact');
    }
}
