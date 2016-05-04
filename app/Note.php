<?php

namespace App;

use App\User;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class Note extends Model {

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['text'];

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
}
