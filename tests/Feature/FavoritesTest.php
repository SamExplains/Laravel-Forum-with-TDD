<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
  use DatabaseMigrations;

      /**
         * @test
         */
          public function guests_can_not_favorite_anything()
          {
            $this->post('replies/1/favorites');
          }

    /**
       * @test
       */
        public function an_authenticated_user_can_favorite_any_reply()
        {
          $reply = create('App\Reply');

          $this->post('replies/{$reply->id}/favorites');
          $this->assertCount(1, $reply->favorites);
        }

}
