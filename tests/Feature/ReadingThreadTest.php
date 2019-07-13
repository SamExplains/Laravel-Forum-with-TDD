<?php

namespace Tests\Feature;

use App\Reply;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReadingThreadTest extends TestCase
{

  use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    protected function setUp(): void
    {
      parent::setUp();
      $this->thread = $thread = factory('App\Thread')->create();
    }

  /**
   * @test
   */
    public function a_user_can_view_all_threads()
    {
      $response = $this->get('/threads')
        ->assertSee($this->thread->title);
    }

    /**
     * @test
     */
    public function a_user_can_read_a_single_thread(){
      $this->get($this->thread->path())
        ->assertSee($this->thread->title);
    }

    /**
     * @test
     */
    function a_user_can_read_replies_that_are_associated_with_channel() {
      /* Generate 1 reply */
      $this->withExceptionHandling();
      $reply = factory(Reply::class)
        ->create(['thread_id' => $this->thread->id]);

      $this->get($this->thread->path())
        ->assertSee($reply->body);
    }

    /**
     *@test
     */
    public function a_user_can_filter_threads_by_any_username(){
        $this->signIn(create('App\User', ['name' => 'JohnDoe']));
        $threadByJohn = create('App\Thread', ['user_id' => auth()->id()]);
        $threadNotByJohn = create('App\Thread');

        $this->get('/threads?by=JohnDoe')
          ->assertSee($threadByJohn->title)
          ->assertDontSee($threadNotByJohn->title);
    }

}
