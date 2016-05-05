<?php

namespace ChurchIC\Models;

use Illuminate\Database\Eloquent\Model;
//use ChurchIC\Models\PhotoEventParticipants;

class PhotoEvent extends Model
{
    protected  $table = 'photo_events';

    protected $fillable = ['client_id', 'name', 'key_photo'];


    public function participants()
    {
        return $this->hasMany('ChurchIC\Models\PhotoEventParticipants');
    }


}
