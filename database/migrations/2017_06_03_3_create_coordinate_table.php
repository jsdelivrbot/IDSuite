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
            $table->uuid('mrge_id');
            $table->primary('mrge_id');
            $table->string('class_code');
            $table->decimal('lat')->default('00.00');
            $table->decimal('long')->default('00.00');
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
        Schema::dropIfExists('coordinate');
    }
}
