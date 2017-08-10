<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDynamicEnumValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::enableForeignKeyConstraints();

        Schema::create('dynamic_enum_value', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id');
            $table->primary('id');
            $table->string('class_code');
            $table->boolean('active')->nullable();

            $table->string('value')->nullable();

            $table->integer('value_type')->nullable();

            $table->uuid('dynamicenum_id')->nullable();

            $table->timestamps();

            $table->index("value_type");
            $table->index("value");


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dynamic_enum_value');
    }
}
