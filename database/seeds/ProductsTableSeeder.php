<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $products = [
            'Baseball Bat',
            'Baseball',
            'Basket Ball',
            'Adidas Sneaker',
            'Active Sneaker',
            'Sport\'s Socks',
            'active Shorts',
            'Stars Shoes',
            'FootBall',
            'HandBall'
            ];
        foreach(range(1, 10) as $index)
        {
            DB::table('products')->insert(
                [
                    'price' => $faker->randomFloat(2,10,100),
                    'name' => $products[$index-1],

                ]
            );
        }
    }
}
