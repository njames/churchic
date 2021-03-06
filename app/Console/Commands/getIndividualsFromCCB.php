<?php

namespace sc\cic\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use sc\cic\ApiHelpers\CcbParser;

class getIndividualsFromCCB extends CicCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cic:getIndividualsFromCCB';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the individuals from CCB';

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
        parent::fire();

        $this->info('Updating individuals changed since: '.$this->option('ChangedSince'));

        $resp = $this->ccbApi->individualProfiles($this->option('ChangedSince'));

        $sxe = $this->parseXml($resp);

        if ($sxe == 1) {
            return 1;
        } // @todo handle xml failure better

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

        array_push($args, ['ChangedSince', null, InputOption::VALUE_OPTIONAL, 'Get all the individuals changed after this date. Format yyy-mmm-dd.', '1970-01-01']);

        return $args;
    }
}
