<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoordinateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('coordinate', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id');
            $table->primary('id');
            $table->string('class_code');
            $table->float('lat', 10, 6)->default(0);
            $table->float('lng', 10, 6)->default(0);
//            $table->uuid('location_id')->nullable();
            $table->timestamps();
        });

//        Schema::table('coordinate', function(Blueprint $table){
//            $table->foreign('location_id')->references('id')->on('location')->onDelete('cascade')->onUpdate('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coordinate');
    }
}
