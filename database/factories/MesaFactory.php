<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mesa;
use Faker\Generator as Faker;

$factory->define(Mesa::class, function (Faker $faker) {
    return [
        'estabelecimento_id' => 1,
        'nome' => 'Mesa 1',
    ];
});
