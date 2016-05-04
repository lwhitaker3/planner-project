<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{

  protected $fillable = ['task_id', 'reminder_time'];
  protected $dates = ['created_at', 'updated_at', 'reminder_time'];


  protected $casts = [
      'user_id' => 'int',
  ];


  public function user() {
    return $this->belongsTo('App\User');
  }
  public function task() {
    return $this->hasOne ('App\Task', 'id', 'task_id');
  }
}
