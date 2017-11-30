<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'username' => $faker->unique()->username,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
	$year = $faker->randomElement(range(1982,2017));
	$mm = $faker->month();
	$dd = $faker->dayOfMonth('28');
	$date = "{$year}-{$mm}-{$dd}";

    return [
       'title' => $faker->sentence,
       'image' => $faker->imageUrl(480,480),
       'body' => $faker->paragraph,
       'date' => $date
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->name,
    ];

});

$factory->define(App\Survey::class, function (Faker\Generator $faker) {
  $email = (rand(1,5) > 1) ? '' : $faker->email;
  $satisfaction = $email ? 'bad' : $faker->randomElement(['good', 'none', 'bad']);
  $comment = (rand(1,3) > 1) ? '' : $faker->sentence;

  return [
    'email' =>  $email,
    'satisfaction' => $satisfaction,
    'comment' => $comment,
  ];
});

// many to many model factory by someone on stackoverflow
// // Populate roles
// factory(App\Role::class, 20)->create();

// // Populate users
// factory(App\User::class, 50)->create();

// // Get all the roles attaching up to 3 random roles to each user
// $roles = App\Role::all();

// // Populate the pivot table
// App\User::all()->each(function ($user) use ($roles) { 
//     $user->roles()->attach(
//         $roles->random(rand(1, 3))->pluck('id')->toArray()
//     ); 
// });