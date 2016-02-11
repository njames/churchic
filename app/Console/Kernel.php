<?php

namespace Cic\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'Cic\Console\Commands\Inspire',
        'Cic\Console\Commands\getGroupParticipantsFromCCB',
        'Cic\Console\Commands\getGroupsFromCCB',
        'Cic\Console\Commands\getIndividualsFromCCB',
        'Cic\Console\Commands\getIndividualsFromCCBInitial',
        'Cic\Console\Commands\putGroupParticipantsToEmail',
        'Cic\Console\Commands\getListsFromEmail',
        'Cic\Console\Commands\ScheduleDB',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('schedule:db')->everyMinute();
    }
}
