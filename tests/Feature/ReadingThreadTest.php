<?php

namespace Tests\Feature;

use App\Reply;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadingThreadTest extends TestCase
{

  use DatabaseMigrations;
  use RefreshDatabase;

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
      $this->get('/threads/' . $this->thread->id)
        ->assertSee($this->thread->title);
    }

    /**
     * @test
     */
    function a_user_can_read_replies_that_are_associated_with_thread() {
      /* Generate 1 reply */
      $this->withExceptionHandling();
      $reply = factory(Reply::class)
        ->create(['thread_id' => $this->thread->id]);

      $this->get('/threads/'. $this->thread->id)
        ->assertSee($reply->body);
    }

}
