<?php namespace sc\cic\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class getListsFromEmail extends CicCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'cic:getListsFromEmail';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Get the lists in the Email program';

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
    parent::fire();
		 // push to mail program
     $this->info('Starting to Sync to email program');

     $mcLists = new \Mailchimp_Lists($this->mailchimp);

//     $mcLists->list()

     $lists = $mcLists->getList();

    dd($lists);
	}

  /**
 	 * Get the console command arguments.
 	 *
 	 * @return array
 	 */
   protected function getArguments()
  	{
     $args = parent::getArguments();

 //    array_push($args, ['example', InputArgument::REQUIRED, 'An example argument.']);
 //
     return $args;
 	}

 	/**
 	 * Get the console command options.
 	 *
 	 * @return array
 	 */
 	protected function getOptions()
 	{
     $args = parent::getOptions();

 //     array_push($args, ['ChangedSince', null, InputOption::VALUE_OPTIONAL, 'Get all the groups changed after this date. Format yyy-mmm-dd.', null] );

     return $args;
 	}

}
