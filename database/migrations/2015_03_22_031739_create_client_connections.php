<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientConnections extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create('client_connections', function(Blueprint $table)
  		{
        $table->increments('id');
  			$table->string('client_id', 30);
  			$table->string('source_name', 60); //CCB, Mailchimp, PCO, etc
  			$table->string('username', 40);
        $table->string('password', 40);
        $table->string('apikey', 40);  // for those apps that use an apikey
        $table->string('consumer_key', 40); //for oauth apps
        $table->string('consumer_secret', 40);
        $table->string('access_token_key', 40);
        $table->string('access_token_secret', 40);
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
    Schema::drop('client_connections');
	}

}
