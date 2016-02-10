<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Model::unguard();

        $this->call('ClientConnectionsSeeder');
        $this->call('UserSeeder');
        $this->call('SyncConfigSeeder');

    }
}
