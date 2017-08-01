<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();



        Schema::create('website', function (Blueprint $table) {

            $table->uuid('id');
            $table->primary('id');
            $table->string('class_code');
            $table->text('url')->nullable();
            $table->string('protocol', 5)->nullable();
            $table->integer('port')->nullable();
            $table->string('user')->nullable();
            $table->string('pass')->nullable();
            $table->string('host')->nullable();
            $table->string('subdomain')->nullable();
            $table->string('domain')->nullable();
            $table->text('path')->nullable();
            $table->text('parameters')->nullable();
            $table->text('fragment')->nullable();

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
        Schema::dropIfExists('website');
    }
}
