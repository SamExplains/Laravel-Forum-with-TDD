<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Channel;
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(\App\Thread::class, function ($faker) {

  return [
    'user_id' => function () {
      return factory(User::class)->create()->id;
    },
    'channel_id' => function() {
      return factory(Channel::class)->create()->id;
    },
    'title' => $faker->sentence,
    'body' => $faker->paragraph,
  ];

});

$factory->define(\App\Channel::class, function ($faker) {
  $name = $faker->word;
  return [
    'name' => $name,
    'slug' => $name,
  ];

});

$factory->define(\App\Reply::class, function ($faker) {

  return [
    'user_id' => function () {
      return factory(User::class)->create()->id;
    },
    'thread_id' => function () {
      return factory(\App\Thread::class)->create()->id;
    },
    'body' => $faker->paragraph,
  ];

});