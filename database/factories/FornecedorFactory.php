<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Fornecedor;

$factory->define(Fornecedor::class, function (Faker $faker) {
    return [
        'razao_social'       => $faker->words,
        'nome_fantasia'      => $faker->unique()->name,
        'cnpj'               => $faker->numberBetween([min(11), max(15)]),
        'inscricao_estadual' => $faker->buildingNumber,
        'inscricao_municipal'=> $faker->buildingNumber,
        'servico_id'         => 2,
        'nome_contato'       => $faker->name,
        'telefone1'          => $faker->phoneNumber,
        'telefone2'          => $faker->phoneNumber,
        'telefone3'          => $faker->phoneNumber,
        'email'              => $faker->email,
        'rua'                => $faker->streetAddress,
        'bairro'             => $faker->streetName,
        'cidade'             => $faker->city,
        'estado'             => $faker->streetSuffix,
        'description'        => $faker->sentence(),
        'remember_token'     => Str::random(10),
        ];
});
