<?php

namespace sc\cic\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoEventParticipants extends Model
{

    protected  $table = 'photo_event_participants';

//    protected $fillable = ['name', 'key_photo'];

    public function PhotoEvent()
    {
        return $this->belongsTo('sc\cic\Models\PhotoEvents');
    }
}
