<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInForum extends TestCase
{
  use DatabaseMigrations;
    /**
     * @test
     */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
      $this->be($user = factory(User::class)->create());
      $thread = factory(Thread::class)->create();
      $reply = factory(Reply::class)->create();


      $this->post('/threads/'. $thread->id .'/replies', $reply->toArray());
      $this->get($thread->path())
        ->assertSee($reply->body);

//      dd($reply->toArray());

    }
}
