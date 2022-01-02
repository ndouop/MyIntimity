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
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        //'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'login' => $faker->unique()->firstName,
        'langue' => $faker->locale,
        //'remember_token',
        //'paramettre_id',
        'tel1' => $faker->numberBetween(600000000,699999999),
        'tel2' => $faker->numberBetween(600000000,699999999),
        'nom' => $faker->firstName,
        'prenom' => $faker->lastName,
        
        //'sexe' => $faker->,
        'addresse_detaille' => $faker->text,
       /* 'couverture',
        'bp_user',
        'ddr',*/
        'duree_ecoulement' => $faker->unixTime,
        'duree_cycle' => $faker->dayOfMonth,
        'heure_notification' => $faker->numberBetween(00,24)
    ];
});
