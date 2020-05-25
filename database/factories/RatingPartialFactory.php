<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\RatingPartial;
use Faker\Generator as Faker;

$factory->define(RatingPartial::class, function (Faker $faker) {
    $score = $faker->randomDigitNotNull;
    $labels = [];
    for ($i = 0; $i <= $score; $i++) {
        $labels[$i] = $faker->word;
    }
    return [
        'name' =>  $faker->word,
        'description' => $faker->sentence,
        'possible_score' => $score,
        'labels' => $labels
    ];
});
