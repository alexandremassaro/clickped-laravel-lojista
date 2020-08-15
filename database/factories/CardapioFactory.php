<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cardapio;
use Faker\Generator as Faker;

$factory->define(Cardapio::class, function (Faker $faker) {
    return [
        'nome' => 'Segunda-feira',
        'estabelecimento_id' => 1,
    ];
});
