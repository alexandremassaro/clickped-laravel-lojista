<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comanda;
use Faker\Generator as Faker;

$factory->define(Comanda::class, function (Faker $faker) {
    return [
        'mesa_id' => 1,
        'user_id' => 2,
        'status' => 0,
    ];
});
