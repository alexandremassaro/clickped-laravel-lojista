<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Estabelecimento;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Estabelecimento::class, function (Faker $faker) {
    $nome = $faker->company;
    return [
        'razao_social' => $nome,
        'nome_fantasia' => $nome,
        'apelido' => $nome,
        'slug' => Str::random(30),
        'cnpj' => Str::random(14)
    ];
});
