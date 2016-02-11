<?php

use Illuminate\Database\Seeder;
use sc\cic\Models\SyncConfig;
use Carbon\Carbon;

class SyncConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sync_configs')->delete();

        SyncConfig::create(
        [
            'client_id' => 'hopeuc',
            'command'   => 'cic:getGroupsFromCCB',
            'last_run' => Carbon::now()
        ]);


    }
}