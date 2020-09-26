<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    /* DEFINE A FUCK PRODUCT NAME AND A FUCK PRODUCT PRICE*/
    return [
        'product_name'=>$faker->word,
        'product_price'=>$faker->randomDigit
    ];
});
