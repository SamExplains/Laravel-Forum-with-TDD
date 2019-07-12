<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
  use DatabaseMigrations;

  protected function setUp(): void
  {
    parent::setUp();
    $this->withExceptionHandling();
  }

  /**
   * @test
   */
  public function unauthenticated_users_may_not_add_replies(){
//    $this->withoutExceptionHandling();
    $this->withExceptionHandling();
//    $this->expectException(AuthenticationException::class);
    $this->post('/threads/some-channel/1/replies', [])
    ->assertRedirect('/login');
  }

    /**
     * @test
     */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {

      $this->be($user = factory(User::class)->create());
      $thread = factory(Thread::class)->create();
      $reply = factory(Reply::class)->make();

      $this->post($thread->path().'/replies', $reply->toArray());
      $this->get($thread->path())
        ->assertSee($reply->body);

    }

    /**
     *@test
     */
    public function a_reply_requires_a_body(){
      $this->withExceptionHandling()->signIn();
      $thread = create('App\Thread');
      $reply = make('App\Reply', ['body' => null]);

      $this->post($thread->path().'/replies', $reply->toArray())
        ->assertSessionHasErrors('body');
    }

    /**
     *@test
     */
    public function a_user_can_filter_threads_according_to_a_tag(){
      $channel = create('App\Channel');
      $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
      $threadNotInChannel = create('App\Thread');

      $this->get('/threads/'. $channel->slug)
        ->assertSee($threadInChannel->title)
        ->assertDontSee($threadNotInChannel->title);

    }

}
