<?php

namespace ChurchIC\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Stripe\Error\Api;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use ChurchIC\Api\Ccb\CcbApi;
use ChurchIC\Models\ApiConnection;
use ChurchIC\Models\IntegrationConfig;
//use Vinkla\Hashids\HashidsManager;
use Illuminate\Support\Facades\Log;

class ChurchICCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ChurchICCommand';

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

    protected $config;


    /**
     * Create a new command instance.
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
        $this->config = IntegrationConfig::find( $this->argument('config') );
        $this->setApis();
    }
    protected function setApis()
    {

//    $this->hashids = new Hashids($this->client); // use clientname as seed

        $clientConnection = ApiConnection::where('client_id', '=', $this->client)
                                          ->where('source_name', '=', 'CCB')->first();

        $this->ccbApi = new CcbApi($clientConnection->client_id, $clientConnection->username, $clientConnection->password);

}

  /**
   * Tidy up after the fire has finished.
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
            array('config', InputArgument::REQUIRED, 'Config id from the database'),
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

    protected function parseXml($input)
    {
        libxml_use_internal_errors(true);

        $sxe = simplexml_load_string($input->getBody());

//    // testing
//    $filename = 'data/individuals-james.xml';
//
//    try
//    {
//        $contents = \File::get($filename);
//
//    }
//    catch (FileNotFoundException $exception)
//    {
//        $this->error("The file doesn't exist");
//    }
//
//    $sxe = simplexml_load_string( $contents );
//
////    dd($contents);
////    // end testing

    if ($sxe === false) {
        $this->error('Failed loading XML');
        Log::error("Failed loading XML in $this->name ");
        foreach (libxml_get_errors() as $error) {
            Log::error($error->message);
        }

        return 1;
    }

        return $sxe;
    }
}
