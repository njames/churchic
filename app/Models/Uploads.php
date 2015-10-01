<?php

namespace sc\cic\Models;

use Illuminate\Database\Eloquent\Model;

class Uploads extends Model
{
    protected  $table = 'users';

    protected $fillable = ['filename', 'stored_filename', 'email'];

}
