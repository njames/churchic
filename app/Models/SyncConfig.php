<?php

namespace sc\cic\Models;

use Illuminate\Database\Eloquent\Model;

class SyncConfig extends Model
{
    protected $fillable = ['from_service', 'from_group', 'to_service', 'to_group', 'run_every', 'last_run'];

    protected $dates = ['created_at', 'updated_at', 'last_run'];
}
