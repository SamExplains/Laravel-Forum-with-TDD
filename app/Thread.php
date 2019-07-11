<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Thread
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread query()
 * @mixin \Eloquent
 */
class Thread extends Model
{
    //

  protected $guarded = [];

  public function path()
  {
    return '/threads/' . $this->id;
  }

  public function replies(){
    return $this->hasMany(Reply::class);
  }

  public function creator(){
    return $this->belongsTo(User::class, 'user_id');
  }

  public function addReply($reply){
    $this->replies()->create($reply);
  }

}
