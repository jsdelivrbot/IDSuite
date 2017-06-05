<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('user', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('mrge_id');
            $table->primary('mrge_id');
            $table->string('class_code');
            $table->uuid('contact_id')->nullable();
            $table->char('password_hash', 64);
            $table->boolean('active');
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });

        Schema::table('user', function(Blueprint $table) {
            $table->foreign('contact_id')->references('mrge_id')->on('contact')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
