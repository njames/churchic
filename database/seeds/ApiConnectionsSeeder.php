<?php

use Illuminate\Database\Seeder;
use ChurchIC\Models\ApiConnection;

/**
 * @author nigeljames
 * @date   23/03/15 9:07 AM
 */
class ApiConnectionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('api_connections')->delete();

        ApiConnection::create(
        [
          'team_id' => 1,
          'api_name' => 'CCB',
          'uri' => 'https://hopeuc.ccbchurch.com/',
          'username' => 'metrics',
          'password' => 'metrics21',
          'apikey' => '',
          'consumer_key' => '',
          'consumer_secret' => '',
          'access_token_key' => '',
          'access_token_secret' => '',
        ]);

        ApiConnection::create(
        [
          'team_id' => 1,
          'api_name' => 'Mailchimp',
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
