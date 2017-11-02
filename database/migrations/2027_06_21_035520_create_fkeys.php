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

        Schema::table('analytic', function(Blueprint $table){
            $table->foreign('numerator_id')->references('id')->on('analytic')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('denominator_id')->references('id')->on('analytic')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('addend_one_id')->references('id')->on('analytic')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('addend_two_id')->references('id')->on('analytic')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('minuend_id')->references('id')->on('analytic')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('subtrahend_id')->references('id')->on('analytic')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('endpoint_id')->references('id')->on('endpoint')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('coordinate', function(Blueprint $table){
            $table->foreign('location_id')->references('id')->on('location')->onDelete('cascade')->onUpdate('cascade');
        });


        Schema::table('dynamic_enum_value', function (Blueprint $table){
            $table->foreign('dynamicenum_id')->references('id')->on('dynamic_enum')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('endpoint', function (Blueprint $table){
            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('model_id')->references('id')->on('endpointmodel')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('proxy_id')->references('id')->on('proxy')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('location_id')->references('id')->on('location')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('links')->references('id')->on('endpointlinks')->onDelete('cascade')->onUpdate('cascade');

        });

        Schema::table('entity', function(Blueprint $table){
            $table->foreign('contact_id')->references('id')->on('entitycontact')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('parent_id')->references('id')->on('entity')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('entitycontact', function (Blueprint $table){
            $table->foreign('entityname_id')->references('id')->on('entityname')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('email_id')->references('id')->on('email')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('location_id')->references('id')->on('location')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('phonenumber_id')->references('id')->on('phonenumber')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('website_id')->references('id')->on('website')->onDelete('cascade')->onUpdate('cascade');

        });

        Schema::table('location', function(Blueprint $table){
            $table->foreign('coordinate_id')->references('id')->on('coordinate')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('personcontact', function(Blueprint $table) {
            $table->foreign('email_id')->references('id')->on('email')->onDelete('cascade')->onUpdate('cascade')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('location_id')->references('id')->on('location')->onDelete('cascade')->onUpdate('cascade')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('personname_id')->references('id')->on('personname')->onDelete('cascade')->onUpdate('cascade')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('phonenumber_id')->references('id')->on('phonenumber')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade')->onUpdate('cascade')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('proxy', function(Blueprint $table) {
            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('cascade')->onUpdate('cascade')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('location_id')->references('id')->on('location')->onDelete('cascade')->onUpdate('cascade')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('record', function(Blueprint $table) {
            $table->foreign('endpoint_id')->references('id')->on('endpoint')->onDelete('cascade')->onUpdate('cascade')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('cascade')->onUpdate('cascade')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('timeperiod_id')->references('id')->on('timeperiod')->onDelete('cascade')->onUpdate('cascade')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('remote_location_id')->references('id')->on('location')->onDelete('cascade')->onUpdate('cascade')->onDelete('cascade')->onUpdate('cascade');

        });

        Schema::table('ticket', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade')->onUpdate('cascade')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('cascade')->onUpdate('cascade')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('personcontact_id')->references('id')->on('personcontact')->onDelete('cascade')->onUpdate('cascade')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('user', function(Blueprint $table) {
            $table->foreign('contact_id')->references('id')->on('personcontact')->onDelete('cascade')->onUpdate('cascade')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('object_dev', function(Blueprint $table){
            $table->foreign('dynamic_enum_value_id')->references('id')->on('dynamic_enum_value')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dynamic_enum_id')->references('id')->on('dynamic_enum')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('entity_user', function(Blueprint $table){
            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('command', function(Blueprint $table){
            $table->foreign('endpoint_id')->references('id')->on('endpoint')->onDelete('cascade')->onUpdate('cascade');
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
