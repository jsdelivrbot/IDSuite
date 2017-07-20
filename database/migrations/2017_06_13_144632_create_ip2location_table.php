<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIp2locationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */


    const table_name = 'ip2location';

    public function up()
    {
        return;

        Schema::create($this::table_name, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            //$table->charset = "utf8";

            $table->unsignedInteger('ip_from')->nullable();
            $table->unsignedInteger('ip_to')->nullable();
            $table->char("country_code", '2')->nullable();
            $table->string("country_name", "64")->nullable();
            $table->string("region_name", "128")->nullable();
            $table->string("city_name", "128")->nullable();
            $table->double("latitude")->nullable();
            $table->double("longitude")->nullable();
            $table->string("zip_code", "30")->nullable();
            $table->string("time_zone", "8")->nullable();

            $table->timestamps();

            $table->index('ip_from');
            $table->index('ip_to');
            $table->index(['ip_from', 'ip_to']);



        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this::table_name);

    }
}
