<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntityNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entityname', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id');
            $table->primary('id');
            $table->string('class_code');
            $table->string('name')->nullable();
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
        Schema::dropIfExists('entityname');
    }
}
