<?php

namespace sc\cic\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use sc\cic\Models\SyncConfig;
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
        $list = SyncConfig::all();

        // for each item in the list check to see if last run + minutes is greater than now

        Log::info($this->signature . ' Starting to check all schedules configured in the database...');

        foreach ($list as $item) {

            $now = Carbon::now();

            if($now->gt($item->last_run->addMinutes($item->run_every))){

                Log::info('Hello ' . $item->clientid  . ' running ' . $item->command);

                $exitCode = Artisan::call( $item->command, [
                    'client' => $item->client_id,
                    'ChangedSince' => $item->last_run->toDateTimeString()
                ]);

                $item->last_run = $now;

                $item->save();
            }

        }
    }
}
