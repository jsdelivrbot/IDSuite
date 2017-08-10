<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXObjectDevTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::enableForeignKeyConstraints();

        Schema::create('x_object_dev', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('object_id')->nullable();
            $table->uuid('dynamic_enum_value_id')->nullable();
            $table->uuid('dynamic_enum_id')->nullable();
            $table->string('object_type')->nullable();
            $table->timestamps();

            $table->index('object_id');
            $table->index('object_type');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('x_object_dev');
    }
}
