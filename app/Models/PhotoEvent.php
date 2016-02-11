<?php

namespace Cic\Models;

use Illuminate\Database\Eloquent\Model;
//use Cic\Models\PhotoEventParticipants;

class PhotoEvent extends Model
{
    protected  $table = 'photo_events';

    protected $fillable = ['client_id', 'name', 'key_photo'];


    public function participants()
    {
        return $this->hasMany('Cic\Models\PhotoEventParticipants');
    }


}
