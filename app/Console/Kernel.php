<?php

namespace ChurchIC\Console;

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
        'ChurchIC\Console\Commands\Inspire',
        'ChurchIC\Console\Commands\getGroupParticipantsFromCCB',
        'ChurchIC\Console\Commands\getGroupsFromCCB',
        'ChurchIC\Console\Commands\getIndividualsFromCCB',
        'ChurchIC\Console\Commands\getIndividualsFromCCBInitial',
        'ChurchIC\Console\Commands\putGroupParticipantsToEmail',
        'ChurchIC\Console\Commands\getListsFromEmail',
        'ChurchIC\Console\Commands\setListsToEmail',
        'ChurchIC\Console\Commands\ScheduleDB',
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
