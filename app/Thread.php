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

  public function path()
  {
    return '/threads/' . $this->id;
  }
}
