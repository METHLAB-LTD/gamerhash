<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(\Database\Seeders\CategoryTableSeeder::class);
        $this->call(\Database\Seeders\ProductTableSeeder::class);
        $this->call(\Database\Seeders\CategoryProductTableSeeder::class);
    }

}
