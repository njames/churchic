<?php

namespace ChurchIC\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use ChurchIC\Models\GroupParticipant;
use Illuminate\Support\Facades\Log;

class putGroupParticipantsToEmail extends ChurchICCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'churchic:putGroupParticipantsToEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Put the Group Participants with the Mail program.';

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

        // push to mail program
     $this->info('Starting to Sync to email program');

        $mcLists = new \Mailchimp_Lists($this->mailchimp);

 //    $mcLists->list

 //    $lists = $mcLists->getList();

     $listId = '2b86d30d93';

        $batch = $this->createMailList(26);

        $result = $mcLists->batchSubscribe($listId, $batch, false, true, true);

        Log::info($result);

        $this->tidyUp();
    }

    private function createMailList($groupId)
    {
        $groupParticipants = GroupParticipant::where('team_id', '=', $this->client)
                               ->where('group_id', '=', $groupId)
                               ->where('receive_email_from_group', '=', true)->get();

        $batch = [];

        foreach ($groupParticipants as $participant) {
            array_push($batch,  ['email' => ['email' => $participant->email], 'email_type' => 'html', 'merge_vars' => ['FNAME' => $participant->first_name, 'LNAME' => $participant->last_name]]);
        }

        return $batch;
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
