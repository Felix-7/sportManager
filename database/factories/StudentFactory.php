<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Student::class, function (Faker $faker) {
    return [
        'name' => $faker->lastName,
        'surname' => $faker->firstName,
        'uid' => $faker->unique()->uuid,
        'skn' => $faker->unique()->uuid,
        'upw' => $faker->password,
        'cur_class' => $faker->numberBetween(1, 8),
        'gender' => $faker->randomElement(['male', 'female']),
        'birth' => $faker->date(1990-01-01, 2010-01-01),
        'group' => $faker->numberBetween(1, 10),
        'teacher' => $faker->numberBetween(1, 5),
        'active' => true,
    ];
});
