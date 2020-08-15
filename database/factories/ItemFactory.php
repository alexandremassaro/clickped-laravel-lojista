<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'nome' => 'Coca-Cola 2l',
        'descricao' => 'Refrigerante Coca-Cola Pet 2 litros',
        'preco' => 8.50,
        'estabelecimento_id' => 1,
    ];
});
