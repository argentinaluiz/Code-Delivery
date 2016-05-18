<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(CodeDelivery\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10)
    ];
});

$factory->define(CodeDelivery\Models\Categoria::class, function(Faker\Generator $faker) {
   return [
     'name'=> $faker->word
   ];
});

$factory->define(CodeDelivery\Models\Produtos::class, function(Faker\Generator $faker) {
   return [
       'nome' => $faker->word,
       'descricao' => $faker->sentence,
       'preco' => $faker->numberBetween(10,50)
   ];
});

$factory->define(CodeDelivery\Models\Cliente::class, function(Faker\Generator $faker) {
    return [
        'numero' => $faker->phoneNumber,
        'endereco' => $faker->address,
        'cidade' => $faker->city,
        'estado' => $faker->state,
        'postcode' => $faker->postcode
    ];
});


