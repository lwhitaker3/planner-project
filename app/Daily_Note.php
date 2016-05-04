<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daily_Note extends Model
{
  protected $table='daily_notes';
  public $timestamps=false;

  protected $fillable = ['day', 'text'];
  protected $dates = ['day'];

  public function user(){
    return $this->belongsTo(User::class);
  }

}
