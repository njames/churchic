<?php

namespace Cic\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Cic\Api\Mailer\Mailchimp\Mailer;
use Cic\Models\GroupParticipant;

class setListsToEmail extends CicCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'cic:setListsToEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy the participants details from a source system to email system';

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

        $this->info('Starting to Sync to email program');

        $mc = new Mailer($this->client);

        // get all the emails from the group
        $gp = GroupParticipant::where('group_id', '=', $this->config->from_group )
                ->whereNotNull('email')
                ->where('updated_at', '>', $this->config->last_run)
                ->get();

        // create a batch and push them
        $batchId = $mc->batchSubscribe($this->config->to_group, $gp);

//        $this->info("Subscribing from list" . $this->config->to_group . " with batch " . $batchId);
        eval(\Psy\sh());

//         // get all the emails from the group to unsubscribe
//        $gp = GroupParticipant::where('group_id', '=', $this->config->from_group )
//                ->whereNotNull('email')
////                ->where('updated_at', '>', $this->config->last_run)
//                ->where('receive_email_from_group',  '=', false )
//                ->get();
//
//        $batchId = $mc->batchUnsubscribe($this->config->to_group, $gp);
//
//        $this->info("Unsubscribing from list" . $this->config->to_group . " with batch " .  $batchId);
//
//        $result = $mc->checkBatch($batchId);
//        dd($result);
//        eval(\Psy\sh());
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

