<?php

namespace Cic\Models;

use Illuminate\Database\Eloquent\Model;

class IntegrationConfig extends Model
{
    protected  $table = 'integration_configs';

    protected $fillable = ['team_id', 'command', 'from_service', 'from_group', 'to_service', 'to_group', 'run_every', 'last_run'];

    protected $dates = ['created_at', 'updated_at', 'last_run'];
}
