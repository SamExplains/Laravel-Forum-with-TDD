<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Reply
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reply query()
 * @mixin \Eloquent
 */
class Reply extends Model
{
  use Favoritable;
    //
  protected $guarded = [];
  protected $with = ['owner', 'favorites'];

  public function owner(){
    return $this->belongsTo(User::class, 'user_id');
  }

}
