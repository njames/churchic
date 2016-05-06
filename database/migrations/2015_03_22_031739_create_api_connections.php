<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiConnections extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('api_connections', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('team_id')->index();
        $table->string('api_name', 60); //CCB, Mailchimp, PCO, etc
        $table->string('uri', 512)->nullable();
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
     */
    public function down()
    {
        Schema::drop('api_connections');
    }
}
