<?php

namespace sc\cic\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoEvent extends Model
{
    protected  $table = 'photo_events';

    protected $fillable = ['name', 'key_photo'];
}
