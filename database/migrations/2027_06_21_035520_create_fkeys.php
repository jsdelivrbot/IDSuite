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

        Schema::table('record', function(Blueprint $table) {
            $table->foreign('endpoint_id')->references('id')->on('endpoint')->onDelete('set null')->onUpdate('set null');
            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('set null')->onUpdate('set null');

            $table->foreign('timeperiod_id')->references('id')->on('timeperiod')->onDelete('set null')->onUpdate('set null'); // double check
            $table->foreign('remote_location_id')->references('id')->on('location')->onDelete('set null')->onUpdate('set null'); // double check

        });

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

        });





        Schema::table('dynamic_enum_value', function (Blueprint $table){
            $table->foreign('dynamicenum_id')->references('id')->on('dynamic_enum')->onDelete('cascade')->onUpdate('cascade');
        });


        Schema::table('object_dev', function(Blueprint $table){
            $table->foreign('dynamic_enum_value_id')->references('id')->on('dynamic_enum_value')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dynamic_enum_id')->references('id')->on('dynamic_enum')->onDelete('cascade')->onUpdate('cascade');
        });


        Schema::table('endpoint', function (Blueprint $table){
           $table->foreign('entity_id')->references('id')->on('entity')->onDelete('cascade')->onUpdate('cascade');

        });

        Schema::table('endpoint_entity', function(Blueprint $table){
            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('endpoint_id')->references('id')->on('endpoint')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('endpointmodel', function(Blueprint $table){
            $table->foreign('id')->references('model_id')->on('endpoint')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('endpointlinks', function(Blueprint $table){
            $table->foreign('id')->references('link_id')->on('endpoint')->onDelete('cascade')->onUpdate('cascade');
        });





        Schema::table('entity', function(Blueprint $table){
            $table->foreign('parent_id')->references('id')->on('entity')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('contact_id')->references('id')->on('entitycontact')->onDelete('set null')->onUpdate('cascade');

        });

        Schema::table('entitycontact', function (Blueprint $table){

            $table->foreign('email_id')->references('id')->on('email')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('website_id')->references('id')->on('website')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('location_id')->references('id')->on('location')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('phonenumber_id')->references('id')->on('phonenumber')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('entityname_id')->references('id')->on('entityname_id')->onDelete('set null')->onUpdate('cascade');

        });


        Schema::table('entityname', function (Blueprint $table){

        });


        Schema::table('personcontact', function(Blueprint $table) {
            $table->foreign('email_id')->references('id')->on('email')->onDelete('set null')->onUpdate('set null');
            $table->foreign('location_id')->references('id')->on('location')->onDelete('set null')->onUpdate('set null');
            $table->foreign('personname_id')->references('id')->on('personname')->onDelete('set null')->onUpdate('set null');
            $table->foreign('phonenumber_id')->references('id')->on('phonenumber')->onDelete('set null')->onUpdate('set null');
            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('set null')->onUpdate('set null');
        });

        Schema::table('proxy', function(Blueprint $table) {
            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('set null')->onUpdate('set null');
            $table->foreign('location_id')->references('id')->on('location')->onDelete('set null')->onUpdate('set null');
        });


        Schema::table('ticket', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('user')->onDelete('set null')->onUpdate('set null');
            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('set null')->onUpdate('set null');
        //    $table->foreign('personcontact_id')->references('id')->on('personcontact')->onDelete('set null')->onUpdate('set null');
        });

        Schema::table('user', function(Blueprint $table) {
            $table->foreign('contact_id')->references('id')->on('personcontact')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('manager_id')->references('id')->on('user')->onDelete('set null')->onUpdate('set null');
        });


        Schema::table('entity_user', function(Blueprint $table){
            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade')->onUpdate('cascade');
        });


       // Schema::table('command', function(Blueprint $table){
      //      $table->foreign('endpoint_id')->references('id')->on('endpoint')->onDelete('cascade')->onUpdate('cascade');
      //  });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // removes all foriegn keys from all tables in selected database
        $query =
            "SELECT concat('ALTER TABLE ', TABLE_NAME, ' DROP FOREIGN KEY ', CONSTRAINT_NAME, ';') 
            FROM information_schema.key_column_usage 
            WHERE CONSTRAINT_SCHEMA = 'db_name' 
            AND referenced_table_name IS NOT NULL;";

        DB::statement($query);


    }
}
