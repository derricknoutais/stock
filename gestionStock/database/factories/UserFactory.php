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
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'type' => $faker->randomElement($array = array ('HB','AD','VR', 'PHD')),
        'name' => $faker->name,
        'cost' => $faker->numberBetween($min = 5000, $max = 9000),
        'stock_initial' => $faker->numberBetween($min = 1000, $max = 30000),
    ];
});


$factory->define(App\FinalProduct::class, function (Faker $faker) {
    return [
        'conditioning' => $faker->randomElement($array = array ('C24X1L','C4X5L','C6X4L','C12X1L','FUTS', 'VRAC')),
        'name' => $faker->name,
        'cost' => $faker->numberBetween($min = 5000, $max = 9000),
        'quantity' => $faker->numberBetween($min = 1000, $max = 30000),
        'conditioning_weight' => $faker->numberBetween($min = 10, $max = 1000),
    ];
});

function localIncrement()
{
    for ($i = 1; $i < 1000; $i++) {
        yield $i;
    }
}
function internationalIncrement()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}
$localIncrement = localIncrement();
$internationalIncrement = internationalIncrement();
$factory->define(App\PurchaseRequest::class, function (Faker $faker) use ($localIncrement, $internationalIncrement) {

    
    
    $local = $faker->randomElement([NULL, $localIncrement->current()]);

    if($local == NULL){
        $internationalIncrement->next();
        $international = $internationalIncrement->current();
    } else {
        $localIncrement->next();
        $international = NULL;
    }
    return [
        'local_id' => $local,
        'international_id' => $international,
        'stock_order_id' => NULL,
        'supplier_id' => $faker->numberBetween(1,10),
        'user_id' => $faker->numberBetween(1,10),
        'observation' => $faker->sentence,
        'object' => $faker->sentence,
    ];
});
$factory->define(App\Supplier::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

// $factory->define(App\Stock::class, function (Faker $faker) {
//     return [
//         'initial_stock' => $faker->numberBetween($min = 5000, $max = 9000),
//         'stock_in' => $faker->numberBetween($min = 5000, $max = 9000),
//         'stock_out' => $faker->numberBetween($min = 5000, $max = 9000),
//         'final_stock' => $faker->

//     ];
// });