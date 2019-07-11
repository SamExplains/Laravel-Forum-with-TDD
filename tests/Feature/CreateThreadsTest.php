<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use function foo\func;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
  use DatabaseMigrations;

  /**
   * @test
   */
  public function guests_may_not_create_threads(){
    $this->expectException('Illuminate\Auth\AuthenticationException');
    $thread = make('App\Thread');
    $this->post('/threads', $thread->toArray());
  }

    /**
     * @test
     */
    public function an_authenticated_user_can_create_forum_threads()
    {
      $this->signIn();
      $thread = make('App\Thread');
      $this->post('/threads', $thread->toArray());

      $this->get($thread->path())
        ->assertSee($thread->title)
        ->assertSee($thread->body);

    }
}
