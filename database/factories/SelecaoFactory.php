<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Selecao;
use Faker\Generator as Faker;

$factory->define(Selecao::class, function (Faker $faker) {
    return [
        'cardapio_id' => 1,
        'categoria_id' => 1,
        'item_id' => 1,
    ];
});
