<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Student::class, function (Faker $faker) {
    return [
        'name' => $faker->lastName,
        'surname' => $faker->firstName,
        'skn' => $faker->unique()->uuid,
        'cur_class' => $faker->numberBetween(1, 8),
        'gender' => $faker->randomElement(['male', 'female']),
        'birth' => $faker->date(1990-01-01, 2010-01-01),
        'group' => $faker->randomElement(['BSPK_5a', 'BSPK_6c', 'BSPM_7a', 'BSPM_7c', 'BSPK_8cr']),
        'active' => true,
    ];
});
