<?php namespace sc\cic\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use GuzzleHttp\Event\BeforeEvent;
use sc\cic\ApiHelpers\CcbApi;
use sc\cic\Models\ClientConnection;
//use Vinkla\Hashids\HashidsManager;
use Illuminate\Support\Facades\Log;


class CicCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'CicCommand';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Base command for Churchic';

  protected $client;

  protected $startTime;
  protected $finishTime;

  protected $ccbApi;
  protected $hashids;
  protected $mailchimp;

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
    $this->start();
    $this->client = $this->argument('client');
    $this->setApis();
	}
  protected function setApis(){

//    $this->hashids = new Hashids($this->client); // use clientname as seed

    $clientConnection = ClientConnection::where('client_id', '=', $this->client)
                                          ->where('source_name', '=', 'CCB')->first();

    $this->ccbApi = new CcbApi($clientConnection->client_id, $clientConnection->username, $clientConnection->password);

    $clientConnection = ClientConnection::where('client_id', '=', $this->client)
                                          ->where('source_name', '=', 'Mailchimp')->first();

    $this->mailchimp =  new \Mailchimp($clientConnection->apikey);

  }

  /**
   * Tidy up after the fire has finished
   *
   */
  public function tidyUp()
  {
    $this->finish();
    $runTime = $this->runTime();
    $msg = "$this->name for $this->client ran in $runTime Seconds";
    Log::info($msg);
    $this->line($msg);
  }

  /**
 	 * Get the console command arguments.
 	 *
 	 * @return array
 	 */
 	protected function getArguments()
 	{
 		return array(
 			array('client', InputArgument::REQUIRED, 'Client id to run this commmand as'),
 		);
 	}

 	/**
 	 * Get the console command options.
 	 *
 	 * @return array
 	 */
 	protected function getOptions()
 	{
 		return array(
// 			array('example_parent', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
 		);
 	}


  protected function start()
  {
    $this->startTime = microtime(true);
  }

  protected function finish()
  {
    $this->finishTime = microtime(true);
  }

  protected function runTime()
  {
    return $this->finishTime - $this->startTime;
  }

  protected function parseXml($input){

    libxml_use_internal_errors(true);

//    $sxe = simplexml_load_string( $input->getBody() );

    // testing
    $filename = 'data/individuals-j.xml';

    try
    {
        $contents = \File::get($filename);

    }
    catch (FileNotFoundException $exception)
    {
        $this->error("The file doesn't exist");
    }

    $sxe = simplexml_load_string( $contents );

//    // end testing

    if ($sxe === false) {
      $this->error("Failed loading XML");
      Log::error( "Failed loading XML in $this->name ");
        foreach(libxml_get_errors() as $error) {
          Log::error($error->message);
        }
      return 1;
    }

    return $sxe;

  }
}