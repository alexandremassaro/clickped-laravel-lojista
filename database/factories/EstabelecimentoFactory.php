<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Estabelecimento;
use Faker\Generator as Faker;

$factory->define(Estabelecimento::class, function (Faker $faker) {
    return [
        'razao_social' => 'Bar do Pepe',//$faker->company,
        'nome_fantasia' => 'Bar do Pepe',
        'cnpj' => '12345678901234',
    ];
});
