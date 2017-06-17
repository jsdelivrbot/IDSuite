<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('customer', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id');
            $table->primary('id');
            $table->string('class_code');
            $table->string('username')->nullable();
            $table->string('email_address')->nullable();
            $table->uuid('contact_id')->nullable();
//            $table->uuid('user_id')->nullable();
            $table->char('password_hash', 64)->nullable();
            $table->boolean('active')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });

        Schema::table('customer', function(Blueprint $table) {
            $table->foreign('contact_id')->references('id')->on('contact')->onDelete('cascade')->onUpdate('cascade');
//            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
}
