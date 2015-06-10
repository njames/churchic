<?php

use Illuminate\Database\Seeder;
use sc\cic\Models\ClientConnection;

/**
 * @author nigeljames
 * @date   23/03/15 9:07 AM
 */
class ClientConnectionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('client_connections')->delete();

        ClientConnection::create(
        [
          'client_id' => 'hopeuc',
          'source_name' => 'CCB',
          'username' => 'metrics',
          'password' => 'metrics21',
          'apikey' => '',
          'consumer_key' => '',
          'consumer_secret' => '',
          'access_token_key' => '',
          'access_token_secret' => '',
        ]);

        ClientConnection::create(
        [
          'client_id' => 'hopeuc',
          'source_name' => 'Mailchimp',
          'username' => '',
          'password' => '',
          'apikey' => '9cf44c0944bf8968211498f59d069676-us8',
          'consumer_key' => '',
          'consumer_secret' => '',
          'access_token_key' => '',
          'access_token_secret' => '',
        ]);
    }
}
