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
        // \App\Models\User::factory(10)->create();
        Product::create([
            'name' => 'Pique Biker Jacket2',
            'slug'  => 'piquebikerjacket2',
            'details'   => 'Pique Biker Jacket',
            'price' => '67.24',
            'description' => 'Pique Biker Jacket',
        ]);
        Product::create([
            'name' => 'Multi-pocket Chest Bag2',
            'slug'  => 'multipocketchestbag2',
            'details'   => 'Multi-pocket Chest Bag',
            'price' => '43.24',
            'description' => 'Multi-pocket Chest Bag',
        ]);
        Product::create([
            'name' => 'Basic Flowing Scarf2',
            'slug'  => 'basicflowingscarf2',
            'details'   => 'Basic Flowing Scarf',
            'price' => '26.24',
            'description' => 'Basic Flowing Scarf',
        ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
