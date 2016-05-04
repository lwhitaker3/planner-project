<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function notes(){
      return $this->hasMany('App\Note');
    }

    public function tasks(){
      return $this->hasMany(Task::class);
    }

    public function categories(){
      return $this->hasMany('App\Category');
    }

    public function reminders(){
      return $this->hasMany('App\Reminder');
    }

    public function daily_notes(){
      return $this->hasMany('App\Daily_Note');
    }
}
