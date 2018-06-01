<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'first_name' => $faker->firstname,
        'last_name' => $faker->lastname,
        'email' => $faker->unique()->safeEmail,
        'role_id'=> $faker->numberBetween($min = 1, $max = 3),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Voiture::class, function (Faker $faker) {
    static $password;

    return [
        'immatriculation' => strtoupper($faker->bothify('??-###-??')),
        "marque" => $faker->randomElement($array = array ('Toyota')),
        "type" => $faker->randomElement($array = array ('Corolla', 'Rav 4', 'Carina E', 'Avensis')),
        "prix" => $faker->randomElement($array = array (30000, 45000, 60000)),
        'date_expiration_assurance' => $faker->dateTimeBetween('+0 days', '+1 month'),
        'date_expiration_carte_grise' => $faker->dateTimeBetween('+0 days', '+1 month'),
        'date_expiration_visite_technique' => $faker->dateTimeBetween('+0 days', '+1 month'),
        'date_expiration_carte_extincteur' => $faker->dateTimeBetween('+0 days', '+1 month'),
        'etat_voiture' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'pneu_secours' => $faker->numberBetween($min = 0, $max = 1),
        'crick' => $faker->numberBetween($min = 0, $max = 1),
        'boite_pharmacie' => $faker->numberBetween($min = 0, $max = 1),
        'triangle' => $faker->numberBetween($min = 0, $max = 1),
        'calle_metallique' => $faker->numberBetween($min = 0, $max = 1),
        'cle_roue' => $faker->numberBetween($min = 0, $max = 1),
        'gilet' => $faker->numberBetween($min = 0, $max = 1),
        'baladeuse' => $faker->numberBetween($min = 0, $max = 1) ,
    ];
});
$factory->define(App\Client::class, function (Faker $faker) {


    return [
        'nom' => $faker->lastname() ,
        'prenom' => $faker->lastname(),
        'date_naissance' => $faker->dateTimeBetween($startDate = '-70 years', $endDate = '-20 years'),
        'addresse' => $faker->address,
        'ville' => $faker->city,
        'numero_permis' => strtoupper($faker->bothify('B##??#??##??')),
        'numero_phone' => $faker->numerify($faker->randomElement($array = array ('07','06','05','04','03','02')) . '######'),
        'numero_phone2' => $faker->numerify($faker->randomElement($array = array ('07','06','05','04','03','02')) . '######'),
        'email' => $faker->freeEmail,
    ];
});
