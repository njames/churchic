<?php

namespace Cic\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Cic\Models\Group;

class getGroupsFromCCB extends CicCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cic:getGroupsFromCCB';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the Groups data from CCB';

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

        $this->info('Updating groups changed since: '.$this->config->last_run->toDateTimeString());

        $resp = $this->ccbApi->groupProfiles($this->config->last_run->toDateTimeString() );

        $sxe = $this->parseXml($resp);

        if ($sxe == 1) {
            return 1;
        }

        foreach ($sxe->response->groups->group as $group) {
            $dbGroup = Group::where('client_id', '=', $this->client)
                       ->where('group_id', '=', $group->attributes())
                       ->first(); // only one row to get

       if (!$dbGroup) {
           $dbGroup = new Group();
       }

            $dbGroup->client_id = $this->client;
            $dbGroup->group_id = $group->attributes();
            $dbGroup->name = $group->name;
            $dbGroup->group_source = 'CCB';
            $dbGroup->description = substr($group->description, 0, 255); // workaround to get first 255 chars so as to not kill field def.
       $dbGroup->campus = $group->campus;

            $dbGroup->save();
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

        array_push($args, ['ChangedSince', null, InputOption::VALUE_OPTIONAL, 'Get all the groups changed after this date. Format yyyy-mmm-dd.', '1970-01-01']);

        return $args;
    }
}
