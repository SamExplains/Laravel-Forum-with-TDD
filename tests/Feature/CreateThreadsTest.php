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

    $this->withExceptionHandling();
    $this->get('/threads/create')
      ->assertRedirect('/login');

    $this->post('/threads')
      ->assertRedirect('/login');
  }
  
//  /**
//   * @test
//   */
//  public function guests_cannot_see_the_create_thread_page(){
//    $this->withExceptionHandling();
//    $this->get('/threads/create')
//      ->assertRedirect('/login');
//  }

    /**
     * @test
     */
    public function an_authenticated_user_can_create_forum_threads()
    {
      $this->withExceptionHandling();
      $this->signIn();
      $thread = create('App\Thread');
      $this->post('/threads', $thread->toArray());

      $this->get($thread->path())
        ->assertSee($thread->title)
        ->assertSee($thread->body);

    }
}

