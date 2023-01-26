<?php

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
        // $this->call(UsersTableSeeder::class);

        // ProductsTableSeederを読み込むように指定
        //$this->call(ProductsTableSeeder::class);

        // CompaniesTableSeederを読み込むように指定
        $this->call(CompaniesTableSeeder::class);

        // SalesTableSeederを読み込むように指定
        //$this->call(SalesTableSeeder::class);
    }
}
