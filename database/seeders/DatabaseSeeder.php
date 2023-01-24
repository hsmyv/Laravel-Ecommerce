<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTableSeeder::class);

         //\App\Models\User::factory(10)->create();
         for ($i=0; $i < 10; $i++) {
              Product::create([
             'name' => "Pique Biker Jackettt$i",
             'slug'  => "piquejackett.$i",
             'details'   => 'Pique Biker Jacket',
             'price' => "6$i.24",
             'description' => 'Pique Biker Jacket',
         ])->categories()->attach(3);
         }


        for ($i = 0; $i < 10; $i++) {
         Product::create([
             'name' => "Multi-pocket Chest Bagg$i",
             'slug'  => "multipocketbagg$i",
             'details'   => 'Multi-pocket Chest Bag',
             'price' => "4$i.24",
             'description' => 'Multi-pocket Chest Bag',
         ])->categories()->attach(4);
        }
        for ($i = 0; $i < 10; $i++) {
         Product::create([
             'name' => "Watchhh$i",
             'slug'  => "watchmodelmm$i",
             'details'   => 'Basic Flowing Watch',
             'price' => "2$i.24",
             'description' => 'Basic Flowing Watch',
         ])->categories()->attach(2);
        }
        for ($i = 0; $i < 10; $i++) {
         Product::create([
             'name' => "Wallettt$i",
             'slug'  => "walletmodelss$i",
             'details'   => 'Basic Flowing wallet',
             'price' => "2$i.24",
             'description' => 'Basic Flowing wallet',
         ])->categories()->attach(5);
        }
        for ($i = 0; $i < 10; $i++) {
         Product::create([
             'name' => "Shoesss$i",
             'slug'  => "shoesmodelmodernn$i",
             'details'   => 'Basic Flowing Shoes',
             'price' => "2$i.24",
             'description' => 'Basic Flowing Shoes',
         ])->categories()->attach(1);
        }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
