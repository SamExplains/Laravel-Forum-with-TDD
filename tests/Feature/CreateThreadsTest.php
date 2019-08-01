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

    /**
     * @test
     */
    public function an_authenticated_user_can_create_forum_threads()
    {
      $this->withExceptionHandling();
      $this->signIn();
      $thread = make('App\Thread');
      $response = $this->post('/threads', $thread->toArray());

      $this->get($response->headers->get('Location'))
        ->assertSee($thread->title)
        ->assertSee($thread->body);

    }

    /**
     *@test
     */
    public function a_thread_requires_a_title(){
      $this->publishThread(['title' => null])
        ->assertSessionHasErrors('title');
    }

    /**
     *@test
     */
    public function a_thread_requires_a_body(){
      $this->publishThread(['body' => null])
        ->assertSessionHasErrors('body');
    }

    /**
     *@test
     */
    public function a_thread_requires_a_valid_channel(){
      factory('App\Channel',2)->create();

      $this->publishThread(['channel_id' => null])
        ->assertSessionHasErrors('channel_id');

      $this->publishThread(['channel_id' => 999])
        ->assertSessionHasErrors('channel_id');
    }

    /**
     *@test
     */
    public function guests_cannot_delete_threads(){
        $this->withExceptionHandling();
        $thread = create('App\Thread');

        $response = $this->delete($thread->path());
//        $response->assertRedirect('/');
        $response->assertStatus(405);
    }

    /**
     *@test
     */
    public function a_thread_can_be_deleted(){
        $this->signIn();
        $thread = create('App\Thread');
        $reply = create('App\Reply', ['thread_id' => $thread->id]);

        $response = $this->json('DELETE', $thread->path());
//        $this->assertDatabaseMissing('threads', $thread->toArray());
        $response->assertStatus(405);
        $this->assertDatabaseMissing('threads', array($thread));
        $this->assertDatabaseMissing('replies', array($reply->id));
    }

//    /**
//     *@test
//     */
//    public function threads_may_only_be_deleted_by_those_who_have_permission(){
//        //TODO
//    }

  /**
   * @param array $overrides
   * @return \Illuminate\Foundation\Testing\TestResponse
   */
    public function publishThread($overrides = []) {
      $this->withExceptionHandling();
      $this->signIn();
      $thread = make('App\Thread', $overrides);
      return $this->post('/threads/destroy', $thread->toArray());
    }





}

