<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegrationConfigTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('integration_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id')->index();
            $table->string('command', 128);
            $table->string('from_service', 20)->nullable();
            $table->string('from_group', 20)->nullable();
            $table->string('to_service', 20)->nullable();
            $table->string('to_group', 20)->nullable();
            $table->integer('run_every')->default(1440);; // number of minutes
            $table->timestamp('last_run');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('integration_configs');
    }
}
