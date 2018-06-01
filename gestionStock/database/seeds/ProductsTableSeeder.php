<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create();
        factory(App\Customer::class, 10)->create();
        factory(App\Supplier::class, 10)->create();
        factory(App\PurchaseRequest::class, 1000)->create();
        factory(App\Product::class, 30)->create();
        factory(App\FinalProduct::class, 60)->create();
        
    }
}
