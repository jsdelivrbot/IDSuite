<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('personcontact', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id');
            $table->primary('id');
            $table->string('class_code');
            $table->uuid('personname_id')->nullable();
            $table->uuid('email_id')->nullable();
            $table->uuid('location_id')->nullable();
            $table->timestamps();
        });

        Schema::table('personcontact', function(Blueprint $table) {
            $table->foreign('email_id')->references('id')->on('email')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('location_id')->references('id')->on('location')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('personname_id')->references('id')->on('personname')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact');
    }
}
