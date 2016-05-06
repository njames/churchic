<?php

namespace ChurchIC\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use ChurchIC\Models\IntegrationConfig;
use Carbon\Carbon;
use Log;

class ScheduleDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Interrogate DB for scheduled commands to run';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $list = IntegrationConfig::all();

        // for each item in the list check to see if last run + minutes is greater than now

        Log::info($this->signature . ' Starting to check all schedules configured in the database...');

        foreach ($list as $item) {

            $now = Carbon::now();

            if($now->gt($item->last_run->addMinutes($item->run_every))){

                Log::info('Scheduled Task ' . $item->id .  ' for:' . $item->clientid  . ' running ' . $item->command);

                $exitCode = $this->call( $item->command, [
                    'client' => $item->client_id,
                    'config' => $item->id
                ]);

                $item->last_run = $now;

                $worked = $item->save();

                $info = $worked ? "Updated task " : "Did not update task ";

                Log::info( $info . $item->id );
            }

        }
    }
}
