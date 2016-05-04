<?php

namespace App;

use App\User;
use App\Note;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table='categories';
  public $timestamps=false;

  protected $fillable = ['name', 'color'];

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function note(){
    return $this->hasMany('App\Note');
  }

  public function task(){
    return $this->hasMany('App\Task');
  }
}
