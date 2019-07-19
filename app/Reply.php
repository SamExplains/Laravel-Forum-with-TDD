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
    //
  protected $guarded = [];

  public function owner(){
    return $this->belongsTo(User::class, 'user_id');
  }

  public function favorites()
  {
    return $this->morphMany(Favorite::class, 'favorited');
  }

  public function favorite()
  {

    $attributes = ['user_id' => auth()->id()];
    if (! $this->favorites()->where($attributes)->exists()) {
      return $this->favorites()->create($attributes);
    }

  }

}
