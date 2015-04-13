<?php namespace sc\cic\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'sc\cic\Console\Commands\Inspire',
		'sc\cic\Console\Commands\getGroupParticipantsFromCCB',
		'sc\cic\Console\Commands\getGroupsFromCCB',
		'sc\cic\Console\Commands\getIndividualsFromCCB',
		'sc\cic\Console\Commands\getIndividualsFromCCBInitial',
		'sc\cic\Console\Commands\putGroupParticipantsToEmail',
		'sc\cic\Console\Commands\runCommands'
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->command('cic:runCommands')->everyTenMinutes();
	}

}
