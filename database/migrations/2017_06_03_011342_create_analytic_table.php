<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalyticTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('analytic', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id');
            $table->primary('id');
            $table->string('class_code');
            $table->uuid('endpoint_id')->nullable();
            $table->integer('analytic_type');
            $table->string('name');
            $table->string('analytic_object_class')->nullable();
            $table->string('analytic_object_relationship')->nullable();
            $table->string('analytic_object_property')->nullable();
            $table->uuid('numerator_id')->nullable();
            $table->uuid('denominator_id')->nullable();
            $table->uuid('addend_one_id')->nullable();
            $table->uuid('addend_two_id')->nullable();
            $table->uuid('minuend_id')->nullable();
            $table->uuid('subtrahend_id')->nullable();
            $table->double('value')->nullable();
            $table->string('stringvalue')->nullable();
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
        Schema::dropIfExists('analytic');
    }
}
