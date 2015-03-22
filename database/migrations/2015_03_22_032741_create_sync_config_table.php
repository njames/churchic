<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSyncConfigTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sync_config', function(Blueprint $table)
    {
  			$table->increments('id');
        $table->string('client_id', 30)->index();
        $table->string('from_service', 20);
        $table->string('from_group', 20);
        $table->string('to_service', 20);
        $table->string('to_group', 20);
        $table->date('last_run');
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
		Schema::drop('sync_config');
	}

}
