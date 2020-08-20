<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ItemPedido;
use Faker\Generator as Faker;

$factory->define(ItemPedido::class, function (Faker $faker) {
    return [
        'nome' => 'Coca-Cola 2l',
        'descricao' => 'Refrigerante Coca-Cola Pet 2 litros',
        'preco' => 8.50,
        'pedido_id' => 1,
        'quantidade' => 1,
    ];
});
