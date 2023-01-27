<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $now = Carbon::now()->toDateTimeString();

        // Category::insert([
        //     ['name' => 'Shoes', 'slug' => 'shoes', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Watches', 'slug' => 'watches', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Coats', 'slug' => 'coats', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Bags', 'slug' => 'bags', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Wallets', 'slug' => 'wallets', 'created_at' => $now, 'updated_at' => $now],

        // ]);
    }
}
