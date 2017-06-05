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

        Schema::create('contact', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('mrge_id');
            $table->primary('mrge_id');
            $table->string('class_code');
            $table->uuid('person_name_id')->nullable();
            $table->uuid('email_id')->nullable();
            $table->uuid('location_id')->nullable();
            $table->timestamps();
        });

        Schema::table('contact', function(Blueprint $table) {
            $table->foreign('email_id')->references('mrge_id')->on('email')->onDelete('cascade');
            $table->foreign('location_id')->references('mrge_id')->on('location')->onDelete('cascade');
            $table->foreign('person_name_id')->references('mrge_id')->on('personname')->onDelete('cascade');
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
