<?php

namespace sc\cic\Console\Commands;

use Illuminate\Console\Command;
use sc\cic\Models\PhotoEventParticipants;
use Vinkla\Hashids\Facades\Hashids;
use Storage;

class updatePhotoEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cic:updatePhotoEvent {eventId : The id of the event to process}';

    protected $eventId;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update a photo events photos for mailchimp export';

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
    public function handle()
    {

        $this->eventId = $this->argument('eventId');
        $this->info("Processing event id: $this->eventId");
    
        $path = 'uploads/photos/' . $this->eventId . '/';
        $time = time();

        $charCountPath = strlen($path);
        $charCountTime = strlen($time);
        // for each file in path uploads/photos/{eventId}/ 
        
        $files = Storage::disk('local')->allFiles($path); //'/'); //
        
        for( $i = 0, $max = count($files); $i < $max; $i++ )
        {
            $this->info($files[$i]);

            if (strstr($files[$i] , 'tn')) {
                continue;         
            }

            // take off the timestamp or tn{timestamp}
            // grab the rest of the name 
            $fullFileName = substr($files[$i], $charCountPath);

            $fileName = substr($files[$i], $charCountPath + $charCountTime);


            $this->info($fileName);
            

            // look for that file in the table
            $query =  PhotoEventParticipants::where('photo_event_id', $this->eventId)
                ->where('photo_original_name', $fileName);
                    
            $participant = $query->first();

            $fileUrl =  public_path() . '/' . $path  . $fullFileName ; 
            $tnFileUrl = url('/') . '/' . $path . 'tn' . $fullFileName ;
            $email_link = route('PhotoEvents.getPhoto', ['eventId' => $participant->photo_event_id, 'hashId' => Hashids::encode($participant->id )] );

            $this->info($fileUrl);
            // $this->info($tnFileUrl);
            $this->info($email_link);

            // update the record
            $success = $query->update(['photo_path_large' => $fileUrl,
                    'photo_path_small' => $tnFileUrl,
                    'email_link' => $email_link ] );

            if($success)
                $this->info(" File $fileName Updated\n");

        }

    }

}