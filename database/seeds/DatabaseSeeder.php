<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @param Faker $faker
   * @return void
   */
    public function run(Faker $faker)
    {
        // $this->call(UsersTableSeeder::class);

      factory(\App\User::class, 50)->create([
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
      ]);

      $threads = factory(\App\Thread::class, function ($faker) {

        return [
          'user_id' => function () {
            return factory(\App\User::class)->create()->id;
          },
          'title' => $faker->sentence,
          'body' => $faker->paragraph,
        ];

      });

      foreach ($threads as $thread) {
        factory(\App\Reply::class, 10)->create([
          'thread_id' => $thread->id,
          'user_id' => function () {
            return factory(\App\User::class)->create()->id;
          },
          'body' => $faker->paragraph,
        ]);
      }

      /*

$threads = factory('App\Thread', 50)->create()
      $threads->each(function ($thread) { factory('App\Reply', 10)->create(['thread_id' => $thread->id]); });


       * */

    }
}
