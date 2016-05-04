<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['title', 'due_date'];
  protected $dates = ['created_at', 'updated_at', 'due_date', 'do_date'];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
      'user_id' => 'int',
  ];

  /**
   * Get the user that owns the task.
   */
  public function user(){
    return $this->belongsTo(User::class);
  }

  public function category(){
    return $this->hasOne('App\Category', 'id', 'category_id');
  }

  public function reminders(){
    return $this->hasMany('App\Reminder');
  }


}
