<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pedido;
use Faker\Generator as Faker;

$factory->define(Pedido::class, function (Faker $faker) {
    return [
        'comanda_id' => 1,
        'estabelecimento_id' => 1,
        'status' => 0,
        'total' => 8.50,
    ];
});
