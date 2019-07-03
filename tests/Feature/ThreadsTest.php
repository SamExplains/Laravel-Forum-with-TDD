<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
  use DatabaseMigrations;
    /**
     * A basic feature test example.
     * @test
     */
  public function a_user_can_browse_threads()
  {
    $thread = factory('App\Thread')->create();
    $response = $this->get('/threads');
    $response->assertSee($thread->title);

    $response = $this->get('/threads/' . $thread->id);

    $response->assertSee($thread->title);

//        $response = $this->get('/');
//        $response->assertStatus(200);
  }
}
