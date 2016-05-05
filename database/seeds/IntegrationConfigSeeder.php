<?php

use Illuminate\Database\Seeder;
use ChurchIC\Models\IntegrationConfig;
use Carbon\Carbon;

class IntegrationConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('integration_configs')->delete();

        IntegrationConfig::create(
        [
            'team_id' => 1,
            'command'   => 'cic:getGroupsFromCCB',
            'run_every' => 60 * 24, // minutes
            'last_run' => Carbon::create(1970, 1, 1)
        ]);


    }
}
