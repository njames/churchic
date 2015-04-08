<?php namespace sc\cic\Console\Commands;

use sc\cic\Console\Commands\CicCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Database\Eloquent;
use Vinkla\Hashids\Facades\Hashids;
use sc\cic\Models\Individual;
use sc\cic\ApiHelpers\CcbParser;


class getIndividualsFromCCBInitial extends CicCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'cic:getIndividualsFromCCBInitial';

  /**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update all the individuals from CCB';


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

    $startsWith  = $this->option('StartsWith');


    $this->info('Updating all individuals who\'s last name starts with: ' . $startsWith);

    $startsWith = strtoupper($startsWith);

    $resp = $this->ccbApi->individualSearch(['last_name'=> $startsWith]);

//      $resp = []; // temp for testing
    //@todo refactor this

    $sxe = $this->parseXml($resp);

//    dd($sxe);

    if($sxe == 1 ) return 1; // @todo handle xml failure better

    // this should be refactored into its own class
    CcbParser::parseIndividuals($sxe, $this->client);


    $this->tidyUp();

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

     array_push($args, ['StartsWith', null, InputOption::VALUE_OPTIONAL, 'Get all the individuals whose last name starts with ', null] );

     return $args;
 	}

}
