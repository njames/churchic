<?php namespace sc\cic\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Carbon\Carbon;

class runCommands extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'cic:runCommands';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'This is the command to run all the commands that have been configured';

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
	public function fire()
	{
		//
    $this->info("Running all the commands.");
    \Log::info( "Running all the commands. Starting " . Carbon::create() );
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
    return [];
//		return [
//			['example', InputArgument::REQUIRED, 'An example argument.'],
//		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
      return [];
//		return [
//			['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
//		];
	}

}
