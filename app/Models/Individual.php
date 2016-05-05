<?php

namespace ChurchIC\Models;

use Illuminate\Database\Eloquent\Model;

class Individual extends Model
{
    //

  protected $dates = ['birthday', 'anniversary', 'membership_date', 'membership_end',
  'udf_date_1', 'udf_date_2', 'udf_date_3', 'udf_date_4', 'udf_date_5', 'udf_date_6', ];
}
