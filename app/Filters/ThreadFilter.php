<?php

namespace App\Filters;

use App\User;

class ThreadFilter extends Filters {

  protected $filters = ['by', 'popular'];


  /**
   * Filter the query by a given username
   * @param $username
   * @return mixed
   */
  protected function by($username)
  {
    $user = User::where('name', $username)->firstOrFail();
    return $this->builder->where('user_id', $user->id);
  }
  
  /**
   *
   */
  protected function popular(){
    $this->builder->getQuery()->orders = [];
      return $this->builder->orderBy('replies_count', 'desc');
  }

}