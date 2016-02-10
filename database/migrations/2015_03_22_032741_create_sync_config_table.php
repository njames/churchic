<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSyncConfigTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sync_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_id', 30)->index();
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
        Schema::drop('sync_configs');
    }
}
