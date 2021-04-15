<?php

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

$factory->define(App\Models\User::class, function (Faker $faker) {
//    return [
//        'name' => $faker->name,
//        'email' => $faker->unique()->safeEmail,
//        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
//        'remember_token' => str_random(10),
//    ];

    return [
        'username'=>$faker->name,
        'password'=>bcrypt('admin'),

    ];
});
//factory(App\Models\Admin\News::class,10)->create();
$factory->define(App\Models\Admin\News::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'cate' =>  $faker->randomElement(['aa', 'bb', 'cc', 'dd']),
        'subCate' =>  $faker->randomElement(['aaaa', 'bbbb', 'cccc', 'dddd']),
        'isShow' => "T",
        'isHot' => "T",
        'isRem' => "T",
        'site' => "aaaa",
        'shot_cont' => $faker->sentence(),
        'src' => "/uploads/product/zvaihBzuXGpfIriZdW3bljr6svpFegGN9XNTkdxr.jpeg",
        'content' => $faker->text(200),
    ];


});