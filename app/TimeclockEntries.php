<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeclockEntries extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'time_in',
    'time_out',
    'user_id'
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'time_in' => 'datetime',
    'time_out' => 'datetime',
  ];
}
