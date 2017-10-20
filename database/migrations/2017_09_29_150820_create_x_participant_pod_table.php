<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXParticipantPodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('participant_pod', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('participant_id')->nullable();
            $table->uuid('pod_id')->nullable();
            $table->boolean('active_status');
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
        Schema::dropIfExists('participant_pod');
    }
}
