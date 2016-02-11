<?php

namespace Cic\Models;

use Illuminate\Database\Eloquent\Model;

class SyncConfig extends Model
{
    protected  $table = 'sync_configs';

    protected $fillable = ['client_id', 'command', 'from_service', 'from_group', 'to_service', 'to_group', 'run_every', 'last_run'];

    protected $dates = ['created_at', 'updated_at', 'last_run'];
}
