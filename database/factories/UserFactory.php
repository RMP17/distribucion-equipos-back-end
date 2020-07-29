<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Persona;
use App\Profesion;
use App\Tecnico;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Usuario::class, function (Faker $faker) {
    $persona =  factory(Persona::class)->create();
    Tecnico::create(['id'=>$persona->id]);
    return [
        'usuario' => 'admin',
//        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'contrasenia' => Hash::make('123'), // secret
        'tecnico_id' =>$persona->id,
        'nivel_acceso' => 0,
    ];
});

$factory->define(App\Persona::class, function (Faker $faker) {
    return [
        'ci' => $faker->randomNumber(8, true),
        'nombre' => $faker->name,
        'apellido1' => $faker->lastName,
        'apellido2' => $faker->lastName,
        'extension' => 'PT',
        'celular' => $faker->randomNumber(8, true),
        'empresa_telefonica' => 'Entel',
        'profesion_id' => factory(Profesion::class)->create(),
    ];
});

$factory->define(App\Profesion::class, function (Faker $faker) {
    return [
        'nombre' => $faker->jobTitle,
    ];
});
