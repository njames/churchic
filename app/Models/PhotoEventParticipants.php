<?php

namespace sc\cic\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoEventParticipants extends Model
{

    protected  $table = 'photo_event_participants';

    protected $fillable = ['client_id', 'photo_event_id', 'first_name', 'last_name', 'email', 'assigned_number',
        'photo_original_name', 'photo_path_large', 'photo_path_small'];

    public function PhotoEvent()
    {
        return $this->belongsTo('sc\cic\Models\PhotoEvents');
    }
}
