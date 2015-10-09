<?php

namespace sc\cic\Models;

use Illuminate\Database\Eloquent\Model;
//use sc\cic\Models\PhotoEventParticipants;

class PhotoEvent extends Model
{
    protected  $table = 'photo_events';

    protected $fillable = ['client_id', 'name', 'key_photo'];


    public function participants()
    {
        return $this->hasMany('sc\cic\Models\PhotoEventParticipants');
    }


}
