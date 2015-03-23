<?php namespace sc\cic\Console\Commands;

use sc\cic\Console\Commands\CicCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Database\Eloquent;
use Vinkla\Hashids\Facades\Hashids;

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


    $this->info('Updating all individuals who\'s last name starts with: ' . $this->option('StartsWith'));


    $resp = $this->ccbApi->individualSearch(['last_name'=> 'a*']);

    //@todo refactor this

    $sxe = $this->parseXml($resp);

//    dd($sxe);

    if($sxe == 1 ) return 1; // @todo handle xml failure better

    // this should be refactored into its own class

    foreach( $sxe->response->individuals->individual as $individual ) {

//      dd($individual);

      $id = $this->hashids->encode($individual->attributes());

      $dbIndividual = \Individual::find($id);

      if(!$dbIndividual){
        $dbIndividual = new \Individual;
      }

      $dbIndividual->id = $id;
      $dbIndividual->client_id = $this->client;
      $dbIndividual->individual_id = $individual->attributes();


      $dbIndividual->first_name  = $individual->first_name ;
      $dbIndividual->last_name = $individual->last_name ;
      $dbIndividual->legal_first_name = $individual->legal_first_name;

      $dbIndividual->sync_id = ( (int) $individual->sync_id != 0 ? (int) $individual->sync_id: null);
      $dbIndividual->other_id = $individual->other_id;
      $dbIndividual->salutation = $individual->salutation;
      $dbIndividual->campus_id = $individual->campus->attributes();
      $dbIndividual->campus = $individual->campus;

      $dbIndividual->save();
    }


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
