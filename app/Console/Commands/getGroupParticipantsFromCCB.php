<?php namespace sc\cic\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Database\Eloquent;

class getGroupParticipantsFromCCB extends CicCommand {
  /**
 	 * The console command name.
 	 *
 	 * @var string
 	 */
 	protected $name = 'cic:getGroupParticipantsFromCCB';

 	/**
 	 * The console command description.
 	 *
 	 * @var string
 	 */
 	protected $description = 'Update the groups participants that have been selected to be updated';

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
     parent::fire();

     $groupsToUpdate = \Group::where('client_id', '=' , $this->client)
                         ->where('sync', '=', true )->get();

     foreach($groupsToUpdate as $group) {

       $this->info("Getting participants for Group: $group->group_id for client $this->client");

       $resp = $this->ccbApi->groupParticipantsByGroupId($group->group_id);

       $sxe = $this->parseXml($resp);

       foreach($sxe->response->groups->group->participants->participant as $participant ) {

         $dbParticipant = \GroupParticipant::where('client_id', '=', $this->client)
           ->where('group_id', '=', $group->group_id)
           ->where('participant_id', '=', $participant->attributes())
           ->first(); // only one row to get

         if (!$dbParticipant) {
           $dbParticipant = new \GroupParticipant();
         }

         $dbParticipant->client_id = $this->client;
         $dbParticipant->group_id = $group->group_id;
         $dbParticipant->participant_id = $participant->attributes();
 //        $dbParticipant->first_name = $participant->first_name;
 //        $dbParticipant->last_name = $participant->last_name;
         $dbParticipant->full_name = $participant->name;
         $dbParticipant->email = $participant->email;
         $dbParticipant->mobile_phone = $participant->mobile_phone;
         $dbParticipant->receive_email_from_church = $participant->receive_email_from_church;
         $dbParticipant->receive_email_from_group = $participant->receive_email_from_group;
         $dbParticipant->receive_sms_from_group = $participant->receive_sms_from_group;
         $dbParticipant->date_joined = $participant->date_joined;
         $dbParticipant->created_at = $participant->created;
         $dbParticipant->updated_at = $participant->modified;

         try{
           $dbParticipant->save();
           $this->info("$participant->name ");
         }
         catch( Exception $e){
           // log the exception and continue
           \Log::error($e);
           $this->error("$participant->name ");
         }

       }

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

 //     array_push($args, ['ChangedSince', null, InputOption::VALUE_OPTIONAL, 'Get all the groups changed after this date. Format yyy-mmm-dd.', null] );

      return $args;
  	}

 }
