<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('endpoint', function (Blueprint $table){
            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('model_id')->references('id')->on('endpointmodel')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('proxy_id')->references('id')->on('proxy')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('location_id')->references('id')->on('location')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('entity', function(Blueprint $table){
            $table->foreign('contact_id')->references('id')->on('entitycontact');
            $table->foreign('parent_id')->references('id')->on('entity');
            $table->foreign('user_id')->references('id')->on('user');
        });

        Schema::table('entitycontact', function (Blueprint $table){
            $table->foreign('entityname_id')->references('id')->on('entityname');
            $table->foreign('email_id')->references('id')->on('email');
            $table->foreign('location_id')->references('id')->on('location');
            $table->foreign('phonenumber_id')->references('id')->on('phonenumber');
            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('location', function(Blueprint $table){
            $table->foreign('coordinate_id')->references('id')->on('coordinate');
        });

        Schema::table('personcontact', function(Blueprint $table) {
            $table->foreign('email_id')->references('id')->on('email')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('location_id')->references('id')->on('location')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('personname_id')->references('id')->on('personname')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('phonenumber_id')->references('id')->on('phonenumber');
        });

        Schema::table('proxy', function(Blueprint $table) {
            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('location_id')->references('id')->on('location')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('record', function(Blueprint $table) {
            $table->foreign('endpoint_id')->references('id')->on('endpoint')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('timeperiod_id')->references('id')->on('timeperiod')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('user', function(Blueprint $table) {
            $table->foreign('contact_id')->references('id')->on('personcontact')->onDelete('cascade')->onUpdate('cascade');
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
